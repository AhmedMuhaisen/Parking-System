<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationRule;
use App\Mail\SendNotificationMail;
use App\Models\Notification_Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

trait NotificationHelper
{
    public function triggerNotificationRules($entityType, $eventType, $entity)
    {
        $rules = Notification_Rule::where('entity_type', $entityType)
            ->where('event_type', $eventType)
            ->get();

        foreach ($rules as $rule) {
            $notification = Notification::create([
                'entity_type' => $entityType,
                'entity_id' => $entity->id,
                'event_type' => $eventType,
                'title' => $rule->title,
                'message' => $rule->message,
                'created_by' => Auth::user()->id ?? 1,
                'target_audience' => $rule->target_audience,
            ]);

            foreach (json_decode($rule->channels) as $channel) {
                $notification->channels()->create(['channel' => $channel]);
                $this->dispatchNotificationToUsers($channel, $notification);
            }
        }
    }

    public function dispatchNotificationToUsers($channel, $notification)
    {
        $users = User::query();

        if ($notification->target_audience === 'admin') {
            $users->where('role', 'admin');
        }

        $recipients = $users->get();

        foreach ($recipients as $user) {
            switch ($channel) {
                case 'email':
                    Mail::to($user->email)->send(new SendNotificationMail($notification, $user));
                    break;

                case 'sms':
                    $this->sendSms($user->phone, $notification->message);
                    break;

                case 'system':
                    $user->systemNotifications()->create([
                        'title' => $notification->title,
                        'message' => $notification->message,
                        'notification_id' => $notification->id,
                    ]);
                    break;
            }
        }

        $notification->channels()->where('channel', $channel)->update([
            'status' => true,
            'sent_at' => now(),
        ]);
    }

    public function sendSms($phone, $message)
    {
        Http::post('https://sms.gateway.com/api/send', [
            'to' => $phone,
            'message' => $message,
        ]);
    }
}

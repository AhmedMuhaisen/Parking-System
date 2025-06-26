<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationRule;
use App\Mail\SendNotificationMail;
use App\Models\Notification_Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    public function trigger(string $entityType, string $eventType, $entity): void
    {
        $rules = Notification_Rule::where('entity_type', $entityType)
            ->where('event_type', $eventType)
            ->get();

        foreach ($rules as $rule) {
            $notification = Notification::create([
                'entity_type' => $entityType,
                'entity_id' => $entity->id,
                'event_type' => $eventType,
                'message' => $rule->message,
                'created_by' => Auth::user()->id ?? 1,
                'target_audience' => $rule->target_audience,
                'user_id' => $rule->user_id ?? null,
            ]);

            foreach (json_decode($rule->channels ?? '[]') as $channel) {
                $notification->channels()->create(['channel' => $channel]);
                $this->dispatch($channel, $notification);
            }
        }
    }

    protected function dispatch(string $channel, Notification $notification): void
    {
        $users = User::query();

        switch ($notification->target_audience) {
            case 'admin':
                $users->where('role', 'admin');
                break;
            case 'user':
                if ($notification->user_id) {
                    $users->where('id', $notification->user_id);
                } else {
                    return;
                }
                break;
            case 'all':
            default:
                // no filters
                break;
        }

        $recipients = $users->get();

        foreach ($recipients as $user) {
            match ($channel) {
                'email' => Mail::to($user->email)->send(new SendNotificationMail($notification, $user)),
                'sms'   => $this->sendSms($user->phone, $notification->message),
                'system'=> $user->systemNotifications()->create([
                                'message' => $notification->message,
                                'notification_id' => $notification->id,
                            ]),
            };
        }

        $notification->channels()->where('channel', $channel)->update([
            'status' => true,
            'sent_at' => now(),
        ]);
    }

    protected function sendSms(string $phone, string $message): void
    {
        Http::post('https://sms.gateway.com/api/send', [
            'to' => $phone,
            'message' => $message,
        ]);
    }
}

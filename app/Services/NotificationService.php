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
use NewSystemNotification;

class NotificationService
{
    public function trigger(string $entityType, string $eventType, $entity): void
    {
        $rules = Notification_Rule::where('entity_type', $entityType)
            ->where('event_type', $eventType)
            ->get();


        foreach ($rules as $rule) {
            $additional=json_decode($rule->additional);
            $createdBy = $additional['created_by'] ?? null;
            $createdAt = $additional['created_at'] ?? null;

              $message=$eventType .' '.$entityType.' '.$entity->id .''.$rule->message;
              if($createdBy){
                $message .=' by '.$createdBy;
              }
                if($createdAt){
                $message .=' at '.$createdAt->format('m-d-y');
              }

            $notification = Notification::create([
                'message' => $message,
                'target_audience' => $rule->target_audience,
                'user_id' => $rule->user_id ?? null,
                'actions'=>$rule->actions ?? null    ]);

            $onr = $rule->onr && method_exists($entity, 'user') ? ($entity->user() ?? null) : false;


            foreach (json_decode($rule->channels ?? '[]') as $channel) {
                $notification->channels()->create(['channel' => $channel]);
                $this->dispatch($channel, $notification,$onr);
            }
        }
    }

    protected function dispatch(string $channel, Notification $notification,$onr): void
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
        if($onr){
             $recipients->push($onr);
        }
        foreach ($recipients as $user) {
            match ($channel) {
                'email' => Mail::to($user->email)->send(new SendNotificationMail($notification, $user)),
                'sms'   => $this->sendSms($user->phone, $notification->message),
                'system'=> $userNotif=$user->systemNotifications()->create([
                 'message' => $notification->message,
                'notification_id' => $notification->id,
                'actions'=>$notification->actions
                            ]),
            };
        }

        $notification->channels()->where('channel', $channel)->update([
            'status' => true,
            'sent_at' => now(),
        ]);
        // event(new NewSystemNotification($userNotif, $user->id));
    }

    protected function sendSms(string $phone, string $message): void
    {
        Http::post('https://sms.gateway.com/api/send', [
            'to' => $phone,
            'message' => $message,
        ]);
    }
}

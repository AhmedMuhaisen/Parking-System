<?php

namespace App\Services;

use App\Events\NewSystemNotification;
use App\Mail\SendNotificationMail;
use App\Models\Notification;
use App\Models\Notification_Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function trigger(string $entityType, string $eventType, $entity): void
    {
        $rules = Notification_Rule::where('entity_type', $entityType)
            ->where('event_type', $eventType)
            ->get();

        foreach ($rules as $rule) {
            $additional = json_decode($rule->additional);
            $createdBy = $additional[0] ?? null;
            $createdAt = $additional[1] ?? null;

            $message = "$eventType $entityType {$entity->id} - {$rule->message} -";

            if ($createdBy) {
                $message .= ' by ' . Auth::user()->first_name . ' ' . Auth::user()->second_name;
            }

            if ($createdAt) {
                $message .= ' at ' . now();
            }

            $notification = Notification::create([
                'message' => $message,
                'target_audience' => $rule->target_audience->users,
                'user_id' => $rule->user_id ?? null,
                'actions' => $rule->actions ?? null,
            ]);

            $onr = $rule->onr && method_exists($entity, 'user') ? ($entity->user ?? null) : null;

            foreach (json_decode($rule->channels ?? '[]') as $channel) {
                $notification->channels()->create(['channel' => $channel]);
                $this->dispatch($channel, $notification, $onr);
            }
        }
    }

    protected function dispatch(string $channel, Notification $notification, $onr): void
    {
        $userIds = collect(json_decode($notification->target_audience));

        if ($onr) {
            $userIds->push($onr->id);
        }

        foreach ($userIds as $user_id) {
            $user = User::find($user_id);
            if (!$user) continue;

            $userNotif = null;

            match ($channel) {
                'email' => Mail::to($user->email)->send(new SendNotificationMail($notification, $user)),
                'sms'   => $this->sendSms($user->phone, $notification->message),
                'system' => $userNotif = $user->systemNotifications()->create([
                    'message' => $notification->message,
                    'notification_id' => $notification->id,
                    'actions' => $notification->actions
                ]),
            };


                broadcast(new NewSystemNotification($user->id, $notification->message));

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

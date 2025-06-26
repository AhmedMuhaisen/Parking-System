<?php

namespace App\Mail;
namespace App\Mail;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notification;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Notification $notification, User $user)
    {
        $this->notification = $notification;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->notification->title)
                    ->view('Dashboard.emails.notification')
                    ->with([
                        'messageContent' => $this->notification->message,
                        'userName' => $this->user->first_name ?? 'User',
                    ]);
    }
}

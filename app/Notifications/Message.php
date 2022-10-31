<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Message extends Notification
{
    use Queueable;

    private $message_id;
    private $sender;
    private $subject;
    public function __construct($message_id, $sender, $subject)
    {
        $this->message_id = $message_id;
        $this->sender = $sender;
        $this->subject = $subject;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "message_id" => $this->message_id,
            "sender" => $this->sender,
            "subject" => $this->subject
        ];
    }
}

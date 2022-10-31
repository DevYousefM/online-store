<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Order extends Notification
{
    use Queueable;

    private $order_id;
    private $create_time;
    private $user;
    public function __construct($order_id, $create_time, $user)
    {
        $this->order_id = $order_id;
        $this->create_time = $create_time;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "order_id" => $this->order_id,
            "create_time" => $this->create_time,
            "user" => $this->user,
        ];
    }
}

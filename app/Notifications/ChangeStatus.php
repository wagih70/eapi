<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangeStatus extends Notification
{
    use Queueable;

    protected $orderId;
    protected $number;
    protected $status;

    public function __construct($orderId, $number,$status)
    {
        $this->orderId = $orderId;
        $this->number = $number;
        $this->status = $status;

    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'orderId' => $this->orderId,
            'number' => $this->number,
            'status' => $this->status
            
        ];
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

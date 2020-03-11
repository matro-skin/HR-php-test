<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompleted extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
    	$this->order = $order;
    	$this->subject = sprintf( __('Заказ №%d завершен'), $this->order->id );
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject($this->subject)
                                ->markdown('emails.orderCompleted', [
	                                'order' => $this->order,
	                                'notifiable' => $notifiable,
	                                'subject' => $this->subject,
                                ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

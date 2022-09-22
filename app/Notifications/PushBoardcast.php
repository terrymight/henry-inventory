<?php

namespace App\Notifications;

use App\Models\customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PushBoardcast extends Notification
{
    use Queueable;

    private customer $pushBroardcast;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(customer $pushBroardcast)
    {
        $this->pushBroardcast = $pushBroardcast;
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
        return (new MailMessage)
                    ->subject('Customer Invoice')
                    ->line($this->pushBroardcast->fullname)
                    ->line('Your invoice is ready you can view it using your invoice no.'. $this->pushBroardcast->invoice_number)
                    ->action('View your invoice now', url('/'))
                    ->line('Thank you for using our application!');
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

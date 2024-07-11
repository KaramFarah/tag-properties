<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendContact extends Notification
{
    use Queueable;
    public $email = '';
    public $name = '';
    public $phone = '';
    public $subject = '';
    public $message = '';

    /**
     * Create a new notification instance.
     */
    public function __construct($form)
    {
        $this->email = $form['email'];
        $this->name = $form['name'];
        $this->subject = $form['subject'];
        $this->phone = $form['phone'];
        $this->message = $form['message'];
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                    ->subject($this->subject)
                    ->greeting('Hello!')
                    ->line('You have recieved new help request.')
                    ->line('Name: ' . $this->name)
                    ->line('Phone: ' . $this->phone)
                    ->line('Email: ' . $this->email)
                    ->line('Message: ' . strip_tags($this->message))
                    ->line('-------------------');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

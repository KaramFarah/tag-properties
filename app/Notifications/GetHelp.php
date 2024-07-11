<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GetHelp extends Notification
{
    use Queueable;
    public $email = '';
    public $name = '';
    public $phone = '';
    public $message = '';

    /**
     * Create a new notification instance.
     */
    public function __construct($form)
    {
        $this->email = $form['email'];
        $this->name = $form['name'];
        $this->phone = $form['phone'];
        $this->message = $form['message'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
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

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $startLineStatement = 'Thank you for registering with us.';

    /**
     * Create a new notification instance.
     *
     * @param bool $newStartLine
     */
    public function __construct($newStartLine = false)
    {
        if ($newStartLine) {
            $this->startLineStatement = $newStartLine;
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {

        $url = route('verification.notice', encrypt($notifiable->email));
        return (new MailMessage)
            ->greeting('Dear ' . $notifiable->profile->fullname())
            ->line($this->startLineStatement)
            ->line('Before you can continue, you\'ll need to verify your email address by clicking the link below.')
            ->action('Verify email', $url)
            ->line('Thank you for choosing us!');
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

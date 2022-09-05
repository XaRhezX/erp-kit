<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $args;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($args)
    {
        $this->args = $args;
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
            ->greeting('Haloo, ' . $notifiable->name)
            ->line('Seseorang telah mencoba untuk melakukan reset password akun Anda. Jika ini adalah Anda, silahkan tekan tombol dibawah untuk melanjutkan..')
            ->action('Reset Password', config('app.url') . "/auth/change-password/" . $this->args->token)
            ->line('Namun jika anda tidak melakukan permintaan reset password silahkan abaikan pesan ini. Selalu jaga kerahasiaan data anda agar tidak terjadi hal yang diluar keinginan!');
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

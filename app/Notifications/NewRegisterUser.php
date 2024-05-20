<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRegisterUser extends Notification implements ShouldQueue
{
    use Queueable;
    public $message;
    public $user_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($register)
    {
        //
        $this->user_id=$register['user_id'];
        $this->message=$register['message'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
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
                    ->line($this->message)
                    ->action('Notification Action', url('/'))
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
            "user_id"=>$this->user_id,
            "message"=>$this->message,
            "notif_for"=>'Create User'
        ];
    }
    
}

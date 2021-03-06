<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificarCreador extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->from("g2cursosinfo@gmail.com", "Equipo de G2Cursos")
            ->subject("Petición de hacerte creador aceptada")
            ->greeting('Hola')
            ->line('¡Enhorabuena! Has sido elegido como creador de cursos.')
            ->action('Empieza a crear cursos', url('/es'))
            ->line('¡Esperamos que crees muchos cursos a lo largo de estos años!')
            ->salutation('Un saludo de parte del equipo de G2Cursos');
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

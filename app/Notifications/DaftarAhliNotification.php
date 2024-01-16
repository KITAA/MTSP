<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DaftarAhliNotification extends Notification
{
    use Queueable;
    public $newMembership;

    /**
     * Create a new notification instance.
     */
    public function __construct($newMembership)
    {
        $this->newMembership = $newMembership;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Permohonan Baru',
            'name' => $this->newMembership->fullname,
            'data' => 'telah mendaftar sebagai Ahli E-khairat',
            'created'=> $this->newMembership->created_at->format('H:i')   
        ];
    }
}

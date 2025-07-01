<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewTourAdded extends Notification
{
    use Queueable;

    public $tour;

    public function __construct($tour)
    {
        $this->tour = $tour;
    }

    public function via($notifiable)
    {
        return ['broadcast', 'database']; // 'mail' can be added if needed
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'New Tour: ' . $this->tour->activity_title,
            'body' => 'A new tour has been added. Check it out!',
            'tour_id' => $this->tour->id,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'New Tour: ' . $this->tour->activity_title,
            'body' => 'A new tour has been added. Check it out!',
            'tour_id' => $this->tour->id,
        ];
    }
}

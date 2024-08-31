<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification
{
    use Queueable;

    private $booking;
    private $statusChange;

    public function __construct($booking, $statusChange)
    {
        $this->booking = $booking;
        $this->statusChange = $statusChange;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Status Update')
            ->line('Your booking status has been updated.')
            ->line('Safari: ' . $this->booking->image)
            ->line('Safari: ' . $this->booking->safariname)
            ->line('Price: ' . $this->booking->price)
            ->line('New Status: ' . $this->statusChange)
            ->line('Arrival Date: ' . $this->booking->arrivalDate)
            ->line('Thank you for using our service!');
    }
}
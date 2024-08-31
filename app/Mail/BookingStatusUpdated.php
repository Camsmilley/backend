<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $subject = $this->booking->status === 'confirmed'
            ? 'Your Booking Has Been Confirmed'
            : 'Your Booking Has Been Cancelled';

        return $this->view('emails.booking-status-updated')
                    ->subject($subject);
    }
}
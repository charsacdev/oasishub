<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\BookingTable;
use Illuminate\Database\Eloquent\Collection;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public BookingTable $booking;
    public Collection $OrderDetails; 

    public function __construct(BookingTable $booking, Collection $OrderDetails)
    {
        $this->booking = $booking;
        $this->OrderDetails = $OrderDetails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation -Oasis Vista Hub',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ordernotification',
            with: [
                'order' => $this->booking,
                'items' => $this->OrderDetails,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}

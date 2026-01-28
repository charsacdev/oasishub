<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BookingTable;

class BookingApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $order,$OrderDetails,$type;

    /**
     * Create a new message instance.
     */
    public function __construct($order,$OrderDetails,$type)
    {
        $this->order = $order;
        $this->OrderDetails = $OrderDetails;
        $this->type = $type;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Order Request Approved - Oasis Vista Hub")
                    ->markdown('mail.booking-approved')
                    ->with([
                        'order'=>$this->order,
                        'items' => $this->OrderDetails,
                        'type' => $this->type,
                    ]);
    }
}

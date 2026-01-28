<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PreOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

     public $order,$type;

    /**
     * Create a new message instance.
     */
    public function __construct($order,$type)
    {
        $this->order = $order;
        $this->type = $type;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Pre Order Request Approved - Oasis Vista Hub")
                    ->markdown('mail.pre-order-email')
                    ->with([
                        'order'=>$this->order,
                        'type' => $this->type,
                    ]);
    }
    
    
}

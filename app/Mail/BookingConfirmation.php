<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $bookingCode;
    public $assetName;

    /**
     * Create a new message instance.
     */
    public function __construct($first_name, $bookingCode, $assetName)
    {
        $this->first_name = $first_name;
        $this->bookingCode = $bookingCode;
        $this->assetName = $assetName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("New Request Confirmation: {$this->bookingCode}")
                    ->markdown('mail.booking-confirmation')
                    ->with([
                        'first_name' => $this->first_name,
                        'bookingCode'  => $this->bookingCode,
                        'assetName'  => $this->assetName,
                    ]);
         }
}

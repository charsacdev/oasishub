<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResettingPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Oasis Vista Hub - Reset Your Password')
                    ->markdown('mail.resetting-password')
                    ->with([
                        'url' => url('/admin/reset-password/' . urlencode($this->token)),
                    ]);
    }
}

<?php

namespace App\Mail;

use App\Models\Preorder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreorderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $preorder;
    public $for;

    public function __construct(Preorder $preorder, $for = 'user')
    {
        $this->preorder = $preorder;
        $this->for = $for;
    }

    public function build()
    {
        $subject = $this->for === 'admin'
            ? 'New Pre-order Request Received Oasis Vista Hub'
            : 'Your Pre-order Request is Received Oasis Vista Hub';

        return $this->subject($subject)
                    ->markdown('mail.preorder-notification');
    }
}


?>
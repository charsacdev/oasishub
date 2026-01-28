<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class ForgotPassword extends Component
{
    public $email;

    public function sendResetLink()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $this->email)->first();

        // Encrypt user email for secure link
        $token = Crypt::encryptString($user->email);

        $resetUrl = url("/newpassword?token={$token}");

        // Send mail
        Mail::send('mail.password-reset', [
            'user' => $user,
            'resetUrl' => $resetUrl
        ], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Password Reset Link - Oasis Vista Hub');
        });

        session()->flash('success', 'A password reset link has been sent to your email.');
    }

    public function render()
    {
        return view('livewire.forgot-password');
    }
}

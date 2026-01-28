<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AdminTable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResettingPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class AdminResetAccess extends Component
{
    public $email;

    public function resetAccess()
    {
        $this->validate([
            'email' => 'required|email|exists:admin_tables,email',
        ]);

        $admin = AdminTable::where('email', $this->email)->first();

        // Generate unique reset code
        $code = Str::random(40);
        $admin->code = $code;
        $admin->save();

        // Encrypt email + code
        $token = encrypt(json_encode([
            'email' => $admin->email,
            'code' => $code,
            'time' => now(),
        ]));

        // Send reset mail
        Mail::to($admin->email)->send(new ResettingPassword($token));

        session()->flash('success', 'We have sent a reset link to your email.');
    }

    public function render()
    {
        return view('livewire.admin-reset-access');
    }
}

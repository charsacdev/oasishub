<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class NewpasswordUser extends Component
{
    public $token;
    public $password;
    public $confirm_password;

    public function mount()
    {
        // Get the encrypted token from the query string
        $this->token = request()->query('token');

        // If no token is provided, redirect to login
        if (!$this->token) {
            return redirect()->route('login'); // Or use the exact route name for your login page
        }
    }

    public function updatePassword()
    {
        try {
            $email = Crypt::decryptString($this->token);
        } catch (\Exception $e) {
            session()->flash('error', 'Invalid or expired password reset link.');
            return;
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            session()->flash('error', 'User not found.');
            return;
        }

        $this->validate([
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6',
        ]);

        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('success', 'Your password has been reset successfully. You can now log in.');
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.newpassword-user');
    }
}

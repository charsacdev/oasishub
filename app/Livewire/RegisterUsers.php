<?php

namespace App\Livewire;

use App\Models\User;
use App\Mail\WelcomeUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RegisterUsers extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function register()
    {
        $this->validate();

        try {
            // Create the user
            $user = User::create([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'profile_status' => '',
                'first_name' => '',
                'last_name' => '',
                'phone' => '',
                'country' => '',
                'house_address' => '',
                'city' => '',
                'state' => '',
                'zip_code' => '',
            ]);

            // Send welcome email
            Mail::to($user->email)->send(new WelcomeUser($user));

            // Flash success message
            session()->flash('success', 'Account created successfully! A welcome email has been sent.');

            // Clear fields
            $this->reset(['email', 'password']);
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating account: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.register-users');
    }
}

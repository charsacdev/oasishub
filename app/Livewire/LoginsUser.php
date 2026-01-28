<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginsUser extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            $user = Auth::user();

            if ($user->profile_status !== 'active') {
                
                session()->flash('error', 'Please update profile information');
                return redirect('dashboard?type=profile');
            }
            else{

                return redirect('dashboard');
            }
            
        }

        $this->addError('email', 'Invalid email or password.');
    }

    public function render()
    {
        return view('livewire.logins-user');
    }
}

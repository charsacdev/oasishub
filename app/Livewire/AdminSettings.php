<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettings extends Component
{

    public $fname, $lname, $email, $phone;
    public $currentPassword, $newPassword, $confirmPassword;

    public function mount()
    {
        $admin = Auth::guard('admin')->user();
        $this->fname = $admin->fname ?? '';
        $this->lname = $admin->lname ?? '';
        $this->email = $admin->email ?? '';
        $this->phone = $admin->phone ?? '';
    }


    #Update Profile
    public function updateProfile()
    {
        $this->validate([
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'email' => 'required|email|unique:admin_tables,email,' . Auth::guard('admin')->id(),
            'phone' => 'nullable|string|max:20',
            #'profile_photo' => 'nullable|image|max:2048', // 2MB max
        ]);

        $admin = Auth::guard('admin')->user();

        $admin->fname = $this->fname;
        $admin->lname = $this->lname;
        $admin->email = $this->email;
        $admin->phone = $this->phone;
        $admin->save();

        session()->flash('success', 'Profile updated successfully.');
    }


    #Update Password
    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|same:confirmPassword',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($this->currentPassword, $admin->password)) {
            session()->flash('error', 'Current password is incorrect.');
            return;
        }

        $admin->password = Hash::make($this->newPassword);
        $admin->save();

        $this->reset(['currentPassword', 'newPassword', 'confirmPassword']);
        session()->flash('success', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin-settings');
    }
}

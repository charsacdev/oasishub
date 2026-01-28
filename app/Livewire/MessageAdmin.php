<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailMessageAdmin;

class MessageAdmin extends Component
{
    public $email;
    public $title;
    public $body; // will hold the HTML from Summernote

    public function sendMessage()
    {
        $this->validate([
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        try {

            Mail::to($this->email)->send(new EmailMessageAdmin($this->title, $this->body));
            session()->flash('success', 'Message sent successfully to ' . $this->email);
            $this->reset(['email', 'title', 'body']);
            return redirect('/admin/messages');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send message: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.message-admin');
    }
}

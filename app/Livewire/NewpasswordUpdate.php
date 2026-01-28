<?php

namespace App\Livewire;

use App\Models\AdminTable;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class NewpasswordUpdate extends Component
{
    public $password;
    public $password_confirmation;
    public $code;

    public function mount()
    {
        #get the last segment directly
        $this->code = request()->route('token');

        #dd(decrypt($this->code));
        
    }



    public function updatePassword(){
                
            $this->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            try {
                // Decrypt the token
                $decrypted = decrypt($this->code);

                // Decode JSON payload
                $payload = json_decode($decrypted, true);

                if (!$payload || !isset($payload['email'])) {
                    session()->flash('error', 'Invalid reset link.');
                    return;
                }

                $admin = AdminTable::where('email', $payload['email'])
                                ->where('code', $payload['code']) // verify the code matches too
                                ->first();

                if (!$admin) {
                    session()->flash('error', 'Invalid reset link.');
                    return;
                }

                // Update password
                $admin->password = Hash::make($this->password);

                // Generate unique reset code
                $code = Str::random(40);
                $admin->code = $code;
                $admin->save();

                session()->flash('success', 'Password updated successfully. You can now login.');
                return redirect('/ultlogin');

            } catch (\Exception $e) {
                session()->flash('error', 'Invalid or expired reset link.');
            }
        }


    public function render()
    {
        
        return view('livewire.newpassword-update')
        ->layout('accounts.newpassword');;
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BookingTable;
use App\Models\Carting;
use Illuminate\Support\Facades\Cookie;

class AccountDashboard extends Component
{
     public $tab = 'dashboard';
    public $first_name;
    public $last_name;
    public $country;
    public $city;
    public $address;
    public $state;
    public $postcode;
    public $phone;
    public $email;

    public $current_password;
    public $new_password;
    public $confirm_password;

    public $orders = [];

    public function mount()
    {
        // Detect query type for tab switching
        $this->tab = request()->query('type', 'dashboard');

        $user = Auth::user();
        if ($user) {
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->country = $user->country;
            $this->city = $user->city;
            $this->address = $user->house_address;
            $this->state = $user->state;
            $this->postcode = $user->zip_code;
            $this->phone = $user->phone;
            $this->email = $user->email;
        }

        $userId = Auth::id();
        $cookieId = Cookie::get('guest_user_id');
      
        $this->orders = BookingTable::with(['cart.product'])
            ->where(function($query) use ($userId, $cookieId) {
                $query->where('user_id', $userId)
                    ->orWhere('cart_id', $cookieId);
            })
            ->whereIn('order_status', ['pending', 'completed'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                // Calculate subtotal (sum of product price * quantity)
                $subtotal = 0;
                foreach ($order->cart as $cartItem) {
                    $subtotal += ($cartItem->product->asset_price ?? 0) * ($cartItem->quantity ?? 1);
                }

                // Optional: Add tax or shipping if needed
                $order->subtotal = $subtotal;
                $order->total = $subtotal;

                return $order;
            });
    }

    public function switchTab($tab)
    {
        $this->tab = $tab;
        return redirect()->route('dashboard', ['type' => $tab]);
    }

    #========UPDATE PROFILE=============#
    public function updateProfile()
    {
        try{
            $this->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'country' => 'required|string',
                'city' => 'required|string',
                'address' => 'required|string',
                'state' => 'required|string',
                'postcode' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email',
            ]);

            $user = auth()->user();
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'country' => $this->country,
                'city' => $this->city,
                'house_address' => $this->address,
                'state' => $this->state,
                'zip_code' => $this->postcode,
                'phone' => $this->phone,
                'email' => $this->email,
                'profile_status'=> 'active'
            ]);

            session()->flash('message', 'Profile updated successfully!');

        }
        catch (\Exception $e) {
           
           session()->flash('error', 'Something went wrong while updating your profile. Please try again.'.$e->getMessage());
        }
        
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|same:confirm_password',
        ]);

        $user = Auth::user();
        if (!password_verify($this->current_password, $user->password)) {
            $this->addError('current_password', 'Current password is incorrect.');
            return;
        }

        $user->update([
            'password' => bcrypt($this->new_password),
        ]);

        session()->flash('message', 'Password changed successfully!');
        $this->reset(['current_password', 'new_password', 'confirm_password']);
    }


    public function render()
    {
        return view('livewire.account-dashboard');
    }
}

?>

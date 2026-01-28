<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssetsTable;
use App\Models\BookingTable;
use App\Models\Preorder;
use Illuminate\Support\Facades\Crypt;

class AdminDashboard extends Component
{
    public $stats = [];
    public $recentBookings = [];

    public $OrderId,$order;

    public function mount()
    {
        if (request()->has('orders')) {

           
            $this->OrderId = Crypt::decrypt(request()->get('orders'));
            $this->order = BookingTable::with('cart.product')->where(['cart_id'=>$this->OrderId,'order_status'=>'pending'])->orWhere(['order_status'=>'completed'])->first();

            #dd($this->OrderId,$this->order);
             
        }

        // Stats
        $this->stats = [
            'uploads'    => AssetsTable::count(),
            'completed' => BookingTable::where('order_status', 'completed')->count(),
            'pending'       => BookingTable::where('order_status', 'pending')->count(),
            'preorders'   => Preorder::where('status','pending')->count(),
        ];

        // Recent Bookings (latest 10)
        $this->recentBookings = BookingTable::with('asset')
            ->latest()
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}

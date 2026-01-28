<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BookingTable;
use App\Models\Carting;
use App\Mail\BookingApproved;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class UserOrders extends Component
{
    public $orders;

    public $OrderId,$order;

    public function mount()
    {
        if (request()->has('orders')) {

           
            $this->OrderId = Crypt::decrypt(request()->get('orders'));
            $this->order = BookingTable::with('cart.product')->where(['cart_id'=>$this->OrderId,'order_status'=>'pending'])->orWhere(['order_status'=>'completed'])->first();

            #dd($this->OrderId,$this->order);
             
        }

        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = BookingTable::with('asset')->latest()->get();
    }


    
    public function approve($id)
    {
        try {
            $ids = $id['cart_id'];

            $order = BookingTable::where('cart_id', $ids)->first();
            if (!$order) {
                throw new \Exception("Order not found.");
            }

            // Update order status
            BookingTable::where('cart_id', $ids)->update([
                'order_status' => 'completed'
            ]);

            $order->update(['order_status' => 'completed']);

            // Update cart status
            Carting::where('cookie_id', $ids)->update(['status' => 'completed']);

            // Fetch order details
            $OrderDetails = Carting::with('product')->where('cookie_id', $ids)->get();

            $type = "approved";

            // Send email
            Mail::to($order->email)->send(new BookingApproved($order, $OrderDetails, $type));

            $this->loadOrders();
            session()->flash('success', 'Order approved and email sent.');
        } catch (\Throwable $e) {
            
            session()->flash('error', 'An error occurred while approving the order. Please try again.');
        }

        return redirect('/admin/orders');
    }


    public function decline($id)
    {
        try {
            $ids = $id['cart_id'];

            $order = BookingTable::where('cart_id', $ids)->first();
            if (!$order) {
                throw new \Exception("Order not found.");
            }

            // Update order status
            BookingTable::where('cart_id', $ids)->update([
                'order_status' => 'declined'
            ]);
            $order->update(['order_status' => 'declined']);

            // Update cart status
            Carting::where('cookie_id', $ids)->update(['status' => 'declined']);

            // Fetch order details
            $OrderDetails = Carting::with('product')->where('cookie_id', $ids)->get();

            $type = "declined";

            // Send email
            Mail::to($order->email)->send(new BookingApproved($order, $OrderDetails, $type));

            $this->loadOrders();
            session()->flash('error', 'Order declined and email sent.');
        } catch (\Throwable $e) {
        
            session()->flash('error', 'An error occurred while declining the order. Please try again.');
        }

        return redirect('/admin/orders');
    }



    public function delete($id)
    {
        $order = BookingTable::findOrFail($id);
        $order->delete();

        $this->loadOrders();
        session()->flash('error', 'Order deleted.');
        return redirect('/admin/orders');
    }

    public function render()
    {
        return view('livewire.user-orders');
    }

}

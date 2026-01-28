<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Preorder;
use App\Models\Carting;
use App\Mail\PreOrderEmail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class PreorderPage extends Component
{
    public $orders;

    public $OrderId,$order;

    public function mount()
    {
        if (request()->has('orders')) {
           
            $this->OrderId = Crypt::decrypt(request()->get('orders'));
            $this->order = Preorder::where(['id'=>$this->OrderId,'status'=>'pending'])->orWhere(['status'=>'approved'])->first();

            #dd($this->OrderId,$this->order);     
        }

        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Preorder::latest()->get();
    }


    
    public function approve($id)
    {
        try {
            $ids = $id['id'];

            $order = Preorder::where('id', $ids)->first();
            if (!$order) {
                throw new \Exception("Pre Order not found.");
            }

            // Update order status
            Preorder::where('id', $ids)->update([
                'status' => 'approved'
            ]);

            $order->update(['status' => 'approved']);

            $type = "approved";

            // Send email
            Mail::to($order->email)->send(new PreOrderEmail($order,$type));

            $this->loadOrders();
            session()->flash('success', 'Pre Order approved and email sent.');
        } catch (\Throwable $e) {
            
            session()->flash('error', 'An error occurred while approving the order. Please try again.'.$e->getMessage());
        }

        return redirect('/admin/preorder');
    }


    public function decline($id)
    {
        try {
            $ids = $id['id'];

            $order = Preorder::where('id', $ids)->first();
            if (!$order) {
                throw new \Exception("Pre Order not found.");
            }

            // Update order status
            Preorder::where('id', $ids)->update([
                'status' => 'declined'
            ]);
            $order->update(['status' => 'declined']);

           
            $type = "declined";

            // Send email
            Mail::to($order->email)->send(new PreOrderEmail($order,$type));

            $this->loadOrders();
            session()->flash('error', 'Pre Order declined and email sent.');
        } catch (\Throwable $e) {
        
            session()->flash('error', 'An error occurred while declining the order. Please try again.'.$e->getMessage());
        }

        return redirect('/admin/preorder');
    }


    

    public function delete($id)
    {
        $order = Preorder::findOrFail($id);
        $order->delete();

        $this->loadOrders();
        session()->flash('error', 'Pre Order deleted.');
        return redirect('/admin/preorder');
    }


    public function render()
    {
        return view('livewire.preorder-page');
    }
}

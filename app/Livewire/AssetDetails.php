<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssetsTable;
use App\Models\BookingTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;


class AssetDetails extends Component
{
    public $asset;
    public $first_name, $last_name, $phone,$email;
    public $showBookingModal = false;
    public $showEmailModal = false;
    public $bookingCode;

    public function mount(){
        try {

            $lastSegment = request()->segment(count(request()->segments()));

            $id =Crypt::decrypt($lastSegment);

            #dd($id);

            // Load the asset
            $this->asset = AssetsTable::findOrFail($id);

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            session()->flash('error', 'Invalid asset URL.');
            return redirect('/');
        }
    }

     #Booking Assets
     public function bookAsset(){

        // Generate booking code
        $this->bookingCode = strtoupper(uniqid("BOOK-"));

        // Insert into booking_tables
        $booking = BookingTable::create([
            'order_id'    => $this->bookingCode,
            'asset_id'    => $this->asset->id,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'asset_type'  => $this->asset->asset_type ?? 'N/A',
            'asset_title' => $this->asset->asset_name,
            'order_status'=> 'pending',
        ]);

        // Send confirmation email
        Mail::to($this->email)->send(new BookingConfirmation(
            $this->first_name,
            $this->bookingCode,
            $this->asset->asset_name
        ));

        // Show next popup
        $this->showBookingModal = false;
        $this->showEmailModal = true;
    }

    public function sendCustomEmail()
    {
        Mail::raw("Here is your booking code: {$this->bookingCode}\nThank you!", function($msg) {
            $msg->to("user@example.com") // replace with real email field
                ->subject("Booking Details");
        });

        session()->flash('success', 'Custom email sent successfully!');
        $this->showEmailModal = false;
    }



    public function render()
    {
        return view('livewire.asset-details');
    }
}

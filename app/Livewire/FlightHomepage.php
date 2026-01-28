<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssetsTable;

class FlightHomepage extends Component
{
    public $assets;
   

    public function mount()
    {
        $this->fetchAssets();
    }

    public function fetchAssets()
    {
        $this->assets = AssetsTable::where(['asset_type'=>'flights'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.flight-homepage');
    }
}

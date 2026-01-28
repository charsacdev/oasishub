<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssetsTable;

class CarsHomepage extends Component
{
     public $assets; // store fetched assets
   

    public function mount()
    {
        $this->fetchAssets();
    }

    public function fetchAssets()
    {
        $this->assets = AssetsTable::where(['asset_type'=>'cars'])->latest()->get();
    }


    public function render()
    {
        return view('livewire.cars-homepage');
    }
}

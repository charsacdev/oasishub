<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssetsTable;

class PropertiesHomepage extends Component
{
     public $assets; // store fetched assets
   

    public function mount()
    {
        $this->fetchAssets();
    }

    public function fetchAssets()
    {
        $this->assets = AssetsTable::where(['asset_type'=>'houses'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.properties-homepage');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssetsTable;

class ManageAssets extends Component
{
    public $assets; // store fetched assets
    public $deleteId; // track asset to delete

    public function mount()
    {
        $this->fetchAssets();
    }

    public function fetchAssets()
    {
        $this->assets = AssetsTable::latest()->get();
    }

    public function confirmDelete($id)
    {
        #dd("Hello");
        $this->deleteId = $id;
        $this->dispatch('showDeleteModal'); // trigger modal

        #dd($this->dispatch('showDeleteModal'));
    }

    public function deleteAsset()
    {
        try {
            AssetsTable::findOrFail($this->deleteId)->delete();
            session()->flash('success', 'Asset deleted successfully.');
            return redirect('/admin/manageproperties');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete asset.');
        }

        $this->deleteId = null;
        $this->fetchAssets();
        $this->dispatch('hide-delete-modal');
    }

    public function render()
    {
        return view('livewire.manage-assets');
    }
}

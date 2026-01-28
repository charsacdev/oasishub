<?php

namespace App\Livewire;

use App\Models\AssetsTable;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CategoryModel;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Crypt;

class UploadAssets extends Component
{
    use WithFileUploads;

    public $property_name;
    public $type;
    public $categories,$category;
    public $price;
    public $description;

    // Photo handling
    public $existing_photos = []; 
    public $new_photos = []; 

    //Asset Id for Update
    public $assetId;


    #Edit Assets
    public function mount(){

        $this->categories=CategoryModel::all();

        #check if asset query param exists
        if (request()->has('asset')) {
            try {
                $this->assetId = Crypt::decrypt(request()->get('asset'));
                $asset = AssetsTable::findOrFail($this->assetId);

                // populate fields
                $this->property_name = $asset->asset_name;
                $this->category = $asset->asset_category;
                $this->type = $asset->asset_type;
                $this->price = $asset->asset_price;
                $this->description = $asset->asset_description;
                $this->existing_photos = json_decode($asset->asset_photos, true) ?? [];


                $this->editing = true;
            } catch (\Exception $e) {
                session()->flash('error', 'Invalid asset link.');
                return redirect('admin/manageproperties');
            }
        }
    }


   #Create or Update
   public function save()
    {
        try {
            // Validate fields
            $this->validate([
                'property_name' => 'required|string|max:255',
                'category'=> 'required|string',
                'type' => 'required|string',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
            ]);

            // Validate only new uploads
            if (!empty($this->new_photos)) {
                $this->validate([
                    'new_photos.*' => 'image|max:10000', // 10MB max each
                ]);
            }

            if(empty($this->new_photos)){
               
                 // Start with existing photos if any
                 $photoPaths = $this->existing_photos ?? [];

            }
            
            // Handle new photo uploads
            if (!empty($this->new_photos)) {
                
                foreach ($this->new_photos as $photo) {
                    // Create a unique filename with .webp extension
                    $filename = uniqid() . '.webp';
                    $path = public_path("uploads/$filename");

                    // Initialize Intervention Image manager
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($photo->getRealPath());

                    // Ensure uploads folder exists
                    if (!file_exists(public_path('uploads'))) {
                        mkdir(public_path('uploads'), 0777, true);
                    }

                    // Convert and save to WebP format (80% quality)
                    $image->toWebp()->save($path, 80);

                    // Save path to array
                    $photoPaths[] = "uploads/$filename";
                }

            }

            // Create or update asset
            $asset = AssetsTable::updateOrCreate(
                ['id' => $this->assetId ?? null],
                [
                    'asset_name'        => $this->property_name,
                    'asset_category'    => $this->category,
                    'asset_type'        => $this->type,
                    'asset_price'       => $this->price,
                    'asset_description' => $this->description,
                    'asset_photos'      => json_encode($photoPaths), // save as JSON
                ]
            );

            session()->flash('success', $this->assetId ? 'Asset updated successfully!' : 'Asset created successfully!');
        
            return redirect('/admin/manageproperties');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save asset: ' . $e->getMessage());
        }
    }

        
    public function render()
    {
        return view('livewire.upload-assets');
    }
}

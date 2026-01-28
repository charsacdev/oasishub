<?php

namespace App\Livewire;

use App\Models\CategoryModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminCategorySettings extends Component
{
    use WithFileUploads;

    public $category_name;
    public $category_image;
    public $categories = [];

    public function mount()
    {
        $this->fetchCategories();
    }

    public function fetchCategories()
    {
        $this->categories = CategoryModel::latest()->get();
    }


    #=====SAVE CATEGORY=======#
    public function saveCategory()
    {
        $this->validate([
            'category_name'  => 'required|string|max:255',
            'category_image' => 'required|image|max:10240', // 10MB max
        ]);

        try {
            // Convert to webp
            $filename = uniqid() . '.webp';
            $path = public_path("uploads/$filename");

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0777, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->category_image->getRealPath());
            $filename = uniqid() . '.webp';
            $path = public_path('uploads/' . $filename);

            // Ensure the uploads directory exists
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0777, true);
            }

            // Convert and save as WebP with 80% quality
            $image->toWebp()->save($path, 80);

            // Store the relative path in your database
            $photoPath = 'uploads/' . $filename;

            // Save to DB
            CategoryModel::create([
                'category_name'  => $this->category_name,
                'category_image' => "uploads/$filename",
            ]);

            // Clear form + refresh list
            $this->reset(['category_name', 'category_image']);
            $this->fetchCategories();

            session()->flash('success', 'Category added successfully!');
            return redirect('/admin/category');
        } 
        catch (\Exception $e) {
            session()->flash('error', 'Failed to save category: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin-category-settings');
    }
}

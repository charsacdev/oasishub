<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preorder;
use Illuminate\Support\Facades\Mail;
use App\Mail\PreorderNotification;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PreorderController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate inputs
            $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'product_category' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'product_description' => 'nullable|string',
                'product_images.*' => 'nullable|image|max:10000', // Multiple images
            ]);

            $photoPaths = [];

            // Handle multiple uploads
            if ($request->hasFile('product_images')) {
                $manager = new ImageManager(new Driver());

                foreach ($request->file('product_images') as $photo) {
                    $filename = uniqid() . '.webp';
                    $path = public_path("uploads/$filename");

                    if (!file_exists(public_path('uploads'))) {
                        mkdir(public_path('uploads'), 0777, true);
                    }

                    $image = $manager->read($photo->getRealPath());
                    $image->toWebp()->save($path, 80);

                    $photoPaths[] = "uploads/$filename";
                }
            }

            // Save to database
            $preorder = Preorder::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'product_category' => $request->product_category,
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'product_image' => json_encode($photoPaths), // Save as JSON
            ]);

            // Send emails
            Mail::to($request->email)->send(new PreorderNotification($preorder, 'user'));
            Mail::to(env('MAIL_ADMIN'))->send(new PreorderNotification($preorder, 'admin'));

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pre-order submitted successfully!'
                ]);
            }

            return back()->with('success', 'Pre-order submitted successfully!');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }

            return back()->with('error', 'Failed to submit pre-order: ' . $e->getMessage());
        }
    }
}

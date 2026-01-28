<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\AssetsTable; // or whatever your product model is
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{

    #===SEARCH PRODUCT===#
    public function search(Request $request)
    {
       
        $categoryId = $request->input('cat');
        $query = $request->input('q');

        // If category is selected, encrypt its ID and redirect
        if ($categoryId) {

            $productId = $categoryId;
            
            //Fetch product by ID
            $product = AssetsTable::where('asset_name',$query)->first();

            return redirect()->route('product.details', ['id' => encrypt($product->id)]);


            // // 🧩 Decode photos
            // $photos = json_decode($product->asset_photos, true) ?? [];

            // // 🧩 Optional: fetch related products
            // $relatedProducts = AssetsTable::where('asset_category', $product->asset_category)
            //     ->where('id', '!=', $product->id)
            //     ->inRandomOrder()
            //     ->limit(6)
            //     ->get();


            // // 🪄 Return to Blade view
            // return view('homepages.product-single', compact('product', 'photos', 'relatedProducts'));
        }

        // If no category, maybe show all results or redirect to generic search page
        return redirect()->route('products.show', ['id' => Crypt::encrypt(0), 'q' => $query]);
    }


    #===========Show Products========#
    public function show($id,Request $request)
    {
        try {
            $categoryId = trim(Crypt::decrypt($id));
        } 
        catch (\Exception $e) {
            return redirect('/');
        }

        
        $query = $request->input('q');

        #dd($categoryId,$query);

       $products = AssetsTable::query()
        ->when(!empty($categoryId), function ($q) use ($categoryId) {
            $q->where('asset_category', $categoryId);
        })
        ->get();


         // If no product found, show all categories instead
        if ($products->isEmpty()) {
            #dd("Hello");
            $products = AssetsTable::all();
            $categoryName = 'All';
        }

        $categoryName = $products->first()->asset_category ?? 'All';

        return view('homepages.products', compact('products', 'categoryName', 'query'));
    }


    #====Product Details====#
    public function showdetails($encryptedId)
    {
        try {
           
            $productId = Crypt::decrypt($encryptedId);
        } 
        catch (\Exception $e) {
            redirect('/');
        }

        #dd($encryptedId);
        //Fetch product by ID
        $product = AssetsTable::findOrFail($productId);

        // 🧩 Decode photos
        $photos = json_decode($product->asset_photos, true) ?? [];

        // 🧩 Optional: fetch related products
        $relatedProducts = AssetsTable::where('asset_category', $product->asset_category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        // 🪄 Return to Blade view
        return view('homepages.product-single', compact('product', 'photos', 'relatedProducts'));
    }


}

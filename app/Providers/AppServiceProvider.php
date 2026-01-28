<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AssetsTable;
use App\Models\CategoryModel;
use App\Models\Carting;
use App\Models\Wishlisting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(){

        View::composer('*', function ($view) {
            $categories = AssetsTable::select('asset_category')
                ->groupBy('asset_category')
                ->get();
            
            $allAssets = AssetsTable::select('asset_category', 'asset_name')
                ->orderBy('asset_category')
                ->get()
                ->groupBy('asset_category');
            
            //Select Featured,New Arrivals and Hot deals
            $featured=AssetsTable::where('asset_type', 'featured product')
            ->inRandomOrder()
            ->limit(12)
            ->get();

            $new=AssetsTable::where('asset_type', 'new arrivals')
            ->inRandomOrder()
            ->limit(12)
            ->get();

            $hot=AssetsTable::where('asset_type', 'hot deals')
            ->inRandomOrder()
            ->limit(12)
            ->get();

            $categoryProduct=CategoryModel::all();

            //Cart Counting 
            $cookieId = Cookie::get('guest_user_id');
            $userId = auth()->id() ?? '0';

            $cartCount = Carting::where(function($query) use ($cookieId, $userId) {
                    $query->where(function($q) use ($cookieId) {
                        $q->where('cookie_id', $cookieId)
                        ->where('status', 'carted');
                    })
                    ->orWhere(function($q) use ($userId) {
                        $q->where('user_id', $userId)
                        ->where('status', 'carted');
                    });
                })
                ->count();

                

            $wishlistCount = Wishlisting::where('cookie_id', $cookieId)
                ->orWhere('user_id', $userId)
                ->count();

            //Fetch cart items with product relation
            $userCookie = Cookie::get('guest_user_id');
            $cartItems = Carting::with('product')
                ->where(['cookie_id'=>$userCookie,'status'=>'carted'])
                ->get();

            #dd($cartItems,$cookieId);

            //Calculate total
            $cartTotal = $cartItems->sum(function($item){
                return $item->quantity * $item->product->asset_price;
            });


            $view->with([
                'categories'=>$categories,
                'allAssets' => $allAssets,
                'featured' => $featured,
                'new' => $new,
                'hot' =>$hot,
                'categoryProduct'=>$categoryProduct,
                'cartCount' => $cartCount,
                'wishlistCount' => $wishlistCount,
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal
            ]);
        });


        // if (!Cookie::has('guest_user_id')) {
        //     $guestId = Str::uuid()->toString();
        //     Cookie::queue('guest_user_id', $guestId, 60 * 24 * 30); // valid 30 days
        //     dd('New guest cookie created: ' . $guestId);
        // } else {
        //     dd('Existing guest cookie: ' . Cookie::get('guest_user_id'));
        // }
        
  }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\NewpasswordUpdate;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PreorderController;
use App\Models\AssetsTable;

Route::fallback(function () {
    return redirect('/'); 
});

Route::middleware(['guest.id'])->group(function () {
        Route::get('/', function () {
            return view('homepages.home');
        });

        Route::get('/about', function () {
            return view('homepages.about');
        });

        Route::get('/wishlist', function () {
            return view('homepages.wishlist');
        });

        Route::get('/get-assets-by-category/{category}', [AssetsTable::class, 'getAssetsByCategory']);
        Route::post('/search', [ProductController::class, 'search'])->name('search.products');
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/product-details/{id}', [ProductController::class, 'showdetails'])->name('product.details');

        // Route::get('/product-details/{id}', function () {
        //     return view('homepages.product-single');
        // });

        Route::get('/cart', function () {
            return view('homepages.cart');
        })->name('checkout.success');

        #===ADD TO CART|WISHLIST===#
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.update');
        Route::post('/wishlist/add', [CartController::class, 'addToWishlist'])->name('wishlist.add');

        #====CHECKOUT====#
        Route::post('/checkout', [CartController::class, 'checkout'])
        ->middleware('profile.active')
        ->name('checkout.store');


        #=====PRE ORDER=====#
        Route::get('/preorder', function() {
            return view('homepages.preorder');
        })->name('preorder.form');

        Route::post('/preorder/store', [PreorderController::class, 'store'])->name('preorder.store');

    });


#==============USERS AUTHENTICATION==============#
Route::get('/register', function () {
            return view('users.register');
});

Route::get('/login', function () {
            return view('users.login');
})->name('login');

Route::get('/forgot', function () {
            return view('users.forget');
});

Route::get('/newpassword', function () {
            return view('users.newpassword');
});



#===========AUTHENTICATED USER===============#
Route::middleware(['auth.user','profile.active','guest.id'])->group(function () {
    
    Route::get('/dashboard', function () {
            return view('users.dashboard');
        })->name('dashboard');    
});

Route::get('/logout', function () {
        Auth::logout(); // Logout the default user guard
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login'); // or use ->to('/login')
    })->name('user.logout');



#==========ADMIN AUTHENTICATION=========#
Route::get('/secureAdminlogin', function () {
    return view('accounts.login');
});

#Logout
Route::get('/admin/logout', function () {
    Auth::guard('admin')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/secureAdminlogin');
})->name('admin.logout');


Route::get('/forgotpassowrd', function () {
    return view('accounts.forgot');
});

Route::get('/admin/reset-password/{token}',NewpasswordUpdate::class)->name('admin.reset.password');




#================ADMIN DASHBOARD============#

Route::middleware('admin.auth')->group(function () {

            Route::get('/admin/dashboard', function () {
                return view('admin.dashboard'); 
            })->name('admin.dashboard');


            Route::get('/admin/properties', function () {
                return view('admin.properties');
            })->name('admin.properties');

            Route::get('/admin/manageproperties', function () {
                return view('admin.managerproperties');
            })->name('admin.manageproperties');


            Route::get('/admin/orders', function () {
                return view('admin.orders');
            })->name('admin.orders');

            Route::get('/admin/preorder', function () {
                return view('admin.preorderpage');
            })->name('admin.preorderpage');


            Route::get('/admin/messages', function () {
                return view('admin.message');
            })->name('admin.messages');


            Route::get('/admin/settings', function () {
                return view('admin.settings');
            })->name('admin.settings');

            Route::get('/admin/category', function () {
                return view('admin.admin-category');
            })->name('admin.category');
});




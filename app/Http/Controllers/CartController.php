<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carting;
use App\Models\BookingTable;
use App\Models\Wishlisting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    #===ADD TO CART===#
    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $guestId = $request->cookie('guest_user_id');
        $userId = Auth::id();

        $cart = Carting::firstOrNew([
            'asset_id' => $productId,
            'cookie_id' => $guestId,
            'user_id' => $userId,
            'status'=>'carted',
        ]);

        $cart->quantity = $quantity;
        $cart->save();

        return response()->json(['count' => Carting::where(['cookie_id'=>$guestId,'status'=>'carted'])->count()]);
    }


    #====UPDATE CART====#
    public function update(Request $request)
    {
        $guestId = $request->cookie('guest_user_id');
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = Carting::where('cookie_id', $guestId)
            ->where('asset_id', $productId)
            ->first();

        if ($cartItem) {
            if ($quantity > 0) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
        }

        $cartItems = Carting::with('product')
            ->where('cookie_id', $guestId)
            ->get();

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->asset_price);

        return response()->json([
            'subtotal' => $cartItem ? $cartItem->quantity * $cartItem->product->asset_price : 0,
            'total' => $total
        ]);
    }


    #===REMOVE CART===#
    public function remove(Request $request)
    {
        $productId = $request->asset_id;
        $guestId = $request->cookie('guest_user_id');

        Carting::where('cookie_id', $guestId)->where('asset_id', $productId)->delete();

        $cartItems = Carting::with('product')
            ->where('cookie_id', $guestId)
            ->get();

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->asset_price);


        $count = Carting::where('cookie_id', $guestId)->sum('quantity');

        return response()->json([
            'total' => $total,
            'count' => $count
        ]);
    }


    #=====CHECK OUT=====#
    public function checkout(Request $request)
    {
        try {
            // If the user is authenticated, use their profile info
            if (auth()->check()) {
                $user = auth()->user();

                $validated = [
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                    'email'      => $user->email,
                    'phone'      => $user->phone,
                    'country'    => $user->country,
                    'address'    => $user->house_address,
                    'city'       => $user->city,
                    'state'      => $user->state,
                    'zip'        => $user->zip_code,
                ];
            } else {
                // Validate guest input
                $validated = $request->validate([
                    'first_name' => 'required|string',
                    'last_name'  => 'required|string',
                    'email'      => 'required|email',
                    'phone'      => 'required|string',
                    'country'    => 'required|string',
                    'address'    => 'required|string',
                    'city'       => 'required|string',
                    'state'      => 'required|string',
                    'zip'        => 'required|string',
                ]);
            }

            // Identify the cart (either from guest cookie or user ID)
            $guestId = $request->cookie('guest_user_id');
            if (!$guestId) {
                $guestId = auth()->id() ?? Str::uuid()->toString(); // fallback for authenticated users
            }

            $orderId = Str::uuid()->toString();

            // Create booking record
            $booking = BookingTable::create([
                'order_id'     => $orderId,
                'cart_id'      => $guestId,
                'asset_id'     => $guestId,
                'first_name'   => $validated['first_name'],
                'last_name'    => $validated['last_name'],
                'email'        => $validated['email'],
                'phone'        => $validated['phone'],
                'country'      => $validated['country'],
                'house_address'=> $validated['address'],
                'city'         => $validated['city'],
                'state'        => $validated['state'],
                'zip_code'     => $validated['zip'],
                'asset_type'   => "0",
                'user_id'      => auth()->id() ?? null,
                'order_status' => 'pending',
            ]);

            // Update cart items
            Carting::where('cookie_id', $guestId)->update(['status' => 'pending']);

            // Get order details
            $OrderDetails = Carting::with('product')->where('cookie_id', $guestId)->get();

            // Send confirmation email
            Mail::to($validated['email'])->send(new OrderNotification($booking, $OrderDetails));

            // Respond for AJAX or redirect
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Order placed successfully, you will get an email notification shortly!',
                    'redirect' => route('checkout.success')
                ]);
            }

            return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage() ?: 'Something went wrong while processing your order. Please try again.';

            if ($request->ajax()) {
                return response()->json(['message' => $errorMessage], 500);
            }

            return redirect()->back()->with('error', $errorMessage);
        }
    }

}

?>
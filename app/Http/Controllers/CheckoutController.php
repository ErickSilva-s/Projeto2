<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    public function create(Request $request)
    {
        $userId = Auth::user()->id;
        $cartItems = CartItem::where('user_id', $userId)->get();
        $productIds = $cartItems->pluck('product_id');

        foreach ($productIds as $productId) {
            $checkout = Checkout::create([
                'paymentMethod' => $request->paymentMethod,
                'address_id' => $request->address_id,
                'user_id' => $userId,
                'product_id' => $productId
            ]);
        }

        return redirect()->route('purchase.success', ['checkout' => $checkout]);
    }
  }

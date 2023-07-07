<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompletedPurchase;


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
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $productIds = $cartItems->pluck('product_id');

        foreach ($productIds as $productId) {
            $checkout = Checkout::create([
                'paymentMethod' => $request->paymentMethod,
                'address_id' => $request->address_id,
                'user_id' => $user->id,
                'product_id' => $productId
            ]);
        }

        $mailData = [
            'title' => 'Seu pedido Feira na Mão',
        ];
        Mail::to($user->email)->send(new CompletedPurchase($mailData));

        return redirect()->route('purchase.success', ['checkout' => $checkout]);
    }
  }

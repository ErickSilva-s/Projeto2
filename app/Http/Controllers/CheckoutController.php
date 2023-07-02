<?php

namespace App\Http\Controllers;

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

  

  public function checkout( Request $request){

    $cartItemsId = $request->cart_id;
    $addressId = $request->address_id;
    $userId = Auth::user()->id;

    Checkout::create([
        'cartItems' => $cartItemsId,
        'formPagamento' => $request->paymentMethod,
        'endereco' => $request->$addressId,
        'user_id' => $userId
    ]);
    return redirect()->route('purchase.complete');
}

   

    // $request->validate([
    //     'formPagamento' => 'required',
    //     'endereco' => 'required',
    // ]);

    //  $checkout = new Checkout();
    //     $checkout->paymentMethod = $request->input('formPagamento');
    //     $checkout->address_id = $request->input('endereco');
    //     $checkout->cart_id = // Obtenha o ID do carrinho de compras do usuário;
    //     $checkout->user_id = Auth::id(); // Obtenha o ID do usuário atualmente logado
    //     $checkout->save();

    //     // Redirecionar para a página de sucesso ou retornar uma resposta adequada
    //     return redirect()->route('purchase.complete');
  }
   

    


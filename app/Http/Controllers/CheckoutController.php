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



  public function create( Request $request){

    $cartItemsId = $request->cart_id;
    // $addressId = $request->address_id;
    $userId = Auth::user()->id;
        
    $checkout= Checkout::create([
        'cart_id' => $cartItemsId,
        'paymentMethod' => $request->paymentMethod,
        'address_id' =>  $request->address_id,
        'product_id' =>  $request->product_id,
        'user_id' => $userId,
    ]);
    return redirect()->route('purchase.success', ['checkout' => $checkout]);
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





    // $checkout->save();



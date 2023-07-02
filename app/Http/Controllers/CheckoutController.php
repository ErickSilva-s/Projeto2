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

  

  /**
   * Summary of store
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|mixed
   */
  public function store( Request $request){


    // Validação dos campos do formulário
    $request->validate([
        'paymentMethod' => 'required',
        'address_id' => 'required',
    ]);

    $cartId = session('cart_id');

    // Criação de um novo objeto Checkout
    $checkout = new Checkout();
    $checkout->paymentMethod = $request->input('paymentMethod');
    $checkout->address_id = $request->input('address_id');
    $checkout->cart_id = $cartId ;
    $checkout->user_id = Auth::id(); 
    

    // Salva o objeto Checkout no banco de dados
    $checkout->save();

    // Redireciona ou executa outras ações após salvar no banco de dados

    // Exemplo de redirecionamento
    return redirect()->route('purchase.complete');





    // $cartItemsId = $request->cart_id;
    // $addressId = $request->address_id;
    // $userId = Auth::user()->id;

    // Checkout::create([
    //     'cartItems' => $cartItemsId,
    //     'paymentMethod' => $request->paymentMethod,
    //     'address_id' => $request->$addressId,
    //     'user_id' => $userId
    // ]);
    // return redirect()->route('purchase.complete');


   

//     $request->validate([
//         'paymentMethod' => 'required',
//         'address_id' => 'required',
//     ]);

//      $checkout = new Checkout();
//         $checkout->paymentMethod = $request->input('paymentMethod');
//         $checkout->address_id = $request->input('address_id');
//         $checkout->cart_id = // Obtenha o ID do carrinho de compras do usuário;
//         $checkout->user_id = Auth::id(); // Obtenha o ID do usuário atualmente logado
//         $checkout->save();

//         // Redirecionar para a página de sucesso ou retornar uma resposta adequada
//         return redirect()->route('purchase.complete');
 }
}
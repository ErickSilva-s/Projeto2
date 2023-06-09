<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::all();

        return view('cart.index', compact('cartItems'));

    }
    public function add(Request $request)
    {
        CartItem::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => Auth::user()->id

        ]);

        return redirect('/product') ->with('status', 'Produto adicionado ao carrinho');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->back()->with('remove', 'Produto removido do carrinho com sucesso!');
    }


    public function empty()
    {

        $user = auth()->user();
        $user->myCarts()->delete();

        return redirect()->back()->with('success');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect('/cart')->with('success', 'Quantidade do produto atualizada com sucesso!');
    }

}
?>

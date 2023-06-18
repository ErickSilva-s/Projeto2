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
        $productId = $request->product_id;
        $userId = Auth::user()->id;

        // Verificar se o produto já está no carrinho
        $existingItem = CartItem::where('product_id', $productId)
                                ->where('user_id', $userId)
                                ->first();

        if ($existingItem) {
            // O produto já está no carrinho, você pode escolher como lidar com isso
            return redirect()->back()->with('status', 'O produto já está no carrinho');
        }

        // O produto não está no carrinho, então pode ser adicionado
        CartItem::create([
            'product_id' => $productId,
            'quantity' => $request->quantity,
            'user_id' => $userId
        ]);

        return redirect()->back()->with('status', 'Produto adicionado ao carrinho');


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

        return redirect('/cart');
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


    public function completePurchase()
{

    $user = Auth::user();
    $user->myCarts()->delete();
    return redirect()->route('purchase.success');
}

}
?>

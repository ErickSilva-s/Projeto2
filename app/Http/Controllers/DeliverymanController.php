<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliverymanController extends Controller
{
    public function index()
    {
        return view('deliveryman.index');

    }

   

    public function assignDeliveryman(Request $request, Checkout $checkout)
{
  
    $deliverymanId = $request->deliveryman_id;
    
    // Verifique se o usuário é um entregador antes de atribuir o ID
    $deliverymanId = $request->deliveryman_id;
    $checkout->update(['deliveryman_id' => $deliverymanId]);

    return redirect('deliveryman.index');

}
}

<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Address::create([
            'number' =>  $request->number,
            'road'  =>  $request->road,
            'cep'  =>  $request->cep,
            'neighborhood'  =>  $request->neighborhood,
            'complement'  =>  $request->complement,
            'user_id' => Auth::user()->id

        ]);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    public function exibirEnderecos(){

        $userId = Auth::id();
        $address = Address::where('user_id', $userId)->get();

        return view('checkout.checkout', ['address' => $address]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $address->update([
            'number' =>  $request->number,
            'road'  =>  $request->road,
            'cep'  =>  $request->cep,
            'neighborhood'  =>  $request->neighborhood,
            'complement'  =>  $request->complement,
        ]);
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect('/dashboard');
    }
}

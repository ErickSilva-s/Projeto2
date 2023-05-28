<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $search= request('search');

        // $unidades = Product::where('description', 'LIKE', '%'.$search.'%')
        //                     ->orWhere('price', 'LIKE', '%'.$search.'%')
        //                     ->orWhere('category', 'LIKE', '%'.$search.'%')
        //                     ->paginate();

        // return view('product.index', compact('unidades', 'search'));
        // if($search){

            // $search= request('search');

        //     $products = Product::where([
        //         ['description', 'price', 'category', 'like', '%'.$search.'%']
        //     ])->get();

        //     return [ 'products' => $products];
        // }else {
        //     $products = Product::all();
        // }

        // $pesquisa = $request->input('pesquisa');
  




        $pesquisa= request('pesquisa');

        $product = Product::where('description', 'like', '%' . $pesquisa . '%')->get();

        return view('product.index', ['product' => $product]);

        

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
        Product::create([
            'description' =>  $request ->description,
            'stock_product' =>  $request ->stock_product,
            'price' =>  $request ->price,
            'category'  =>  $request ->category,
            'user_id' => Auth::user()->id

        ]);

        return redirect('/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'description' =>  $request ->description,
            'stock_product' =>  $request ->stock_product,
            'price' =>  $request ->price,
            'category'  =>  $request ->category
        ]);
        return redirect ('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/product');
    }

    /**
     * Summary of pesquisar
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
//     public function pesquisar(Request $request)
// {
//     $pesquisa = $request->input('pesquisa');

//     $produtos = Product::where('nome', 'like', '%' . $pesquisa . '%')->get();

//     return view('product.index', ['product' => $produtos]);
// }
}

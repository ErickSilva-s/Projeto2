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


        $pesquisa = request('pesquisa');
        if (Auth::user() && (Auth::user()->type == 'vendedor')) {
            $user = Auth::user(); // Obtém o usuário atualmente autenticado (exemplo usando o Laravel)

            $product = Product::where('description', 'like', '%' . $pesquisa . '%')
                ->where('user_id', $user->id) // Adiciona a condição para buscar apenas os produtos do usuário atual
                ->get();

            return view('product.index', ['product' => $product]);
        } else {
            $product = Product::where('description', 'like', '%' . $pesquisa . '%')->get();
            return view('product.index', ['product' => $product]);
        }
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
        $product = new Product;

        $product->description =  $request->description;
        $product->stock_product =  $request->stock_product;
        $product->price =  $request->price;
        $product->category  =  $request->category;
        $product->user_id = Auth::user()->id;




        //Upload imagem

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->imagem;

            $extension = $requestImagem->extension();

            //esse md5 cria um hash da imagem para evitar que sejam salvos imagens iguais e concatena com a extenção;
            $imagemName = md5($requestImagem->getClientOriginalName() . strtotime("now")) . "." . $extension;

            //Guarda o path da imagem no banco e ela em si fica em uma pagina dentro do projeto, ou seja ela fica no servidor ('img/imagemProducts');
            $requestImagem->move(public_path('/img/imgProduct'), $imagemName);

            // 'imagem'=> $request -> $imagemName;

            $product->imagem = $imagemName;
        };

        $product->save();
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
            'description' =>  $request->description,
            'stock_product' =>  $request->stock_product,
            'price' =>  $request->price,
            'category'  =>  $request->category
        ]);
        return redirect('product');
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

}

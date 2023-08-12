<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        if (Auth::check() && Auth::user()->type == 'entregador') {
            return     redirect('/deliveries');
        }

        if (Auth::check() && Auth::user()->type == 'vendedor') {
            $user = Auth::user();
            $products = Product::where('description', 'like', '%' . $pesquisa . '%')
                ->where('user_id', $user->id)
                ->get();
        } else {
            $products = Product::where('description', 'like', '%' . $pesquisa . '%')->get();
        }

        return view('product.index', ['products' => $products, 'pesquisa' => $pesquisa]);
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

        $user = Auth::user();

        if ($user->type == 'vendedor' && !$user->email_verified_at) {
            return redirect()->route('verification.notice');
        }

        $request->validate([
            'imagem' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            // o mimes especifica o tipo dos arquivos; o max esta especificando o tamanho em kilobyte.
        ], [
            'imagem.mimes' => 'O tipo de arquivo enviado não é suportado. Por favor, envie um arquivo JPEG, PNG ou JPG.',
        ]);

        $product = new Product;

        $product->description =  $request->description;
        $product->stock_product =  $request->stock_product;
        $product->price =  $request->price;
        $product->category  =  $request->category;
        $product->user_id = $user->id;




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
        }




        $product->save();
        return redirect('/product')->with('success', 'Produto adicionado com sucesso!!');
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $product->id)->get();

        return view('product.show', compact('product', 'reviews'));
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

    public function submitReview(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $user = Auth::user();

        $review = new Review();
        $review->product_id = $product->id;
        $review->user_id = $user->id;
        $review->rating = $request->input('rating');
        $review->title = $request->input('title');
        $review->comment = $request->input('comment');
        $review->save();

        // Redirecionar de volta à página do produto com uma mensagem de sucesso
        return redirect()->back()->with('sent', 'Avaliação enviada com sucesso!');
    }

    public function destroyReview(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', 'Avaliação apagada com sucesso.');
    }


    public function markReviewChecked($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->checked = true;
        $review->save();

        return redirect()->back()->with('checked', 'Avaliação marcada como verificada com sucesso');
    }

    /**
     * Summary of pesquisar
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */


    public function like($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->increment('likes');
        return response()->json(['success' => true]);
    }

    public function dislike($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->decrement('likes');
        return response()->json(['success' => true]);
    }
}

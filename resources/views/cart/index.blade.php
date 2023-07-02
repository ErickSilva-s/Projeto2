<x-app-layout>
    <x-slot name="header">
        @if(Auth::user())
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Olá, {{ Auth::user()->name }}, esse é o seu carrinho de compras <br>
        </h2>
        <p> Você está logado com {{ Auth::user()->email }}. <br>
            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl mt-4 font-bold text-center text-green-800 "> Seu Carrinho de Compras</h1>
                    <br>

                    @php
                    $totalCarrinho = 0;
                    @endphp

                    @if (session('success'))
                    <div x-data="{show:true}">
                        <div class="p-4 bg-green-300 w-full" x-show="show">
                            {{ session('success') }}
                            <span class="float-right cursor-point" x-on:click="show=false">&times;</span>
                        </div>
                    </div>
                    @endif

                    @if (session('remove'))
                    <div x-data="{show:true}">
                        <div class="p-4 bg-green-300 w-full" x-show="show">
                            {{ session('remove') }}
                            <span class="float-right cursor-point" x-on:click="show=false">&times;</span>
                        </div>
                    </div>
                    @endif

                    @if(count(Auth::user()->myCarts) > 0)

                    <!-- MOSTRAR O TOTAL DO CARRINHO NO TOPO -->

                    <div class="">
                        @foreach (Auth::user()->myCarts as $cartItem)
                        @foreach (App\Models\Product::all() as $product)
                        @if($cartItem->product_id == $product->id)

                        @php
                        $totalCarrinho += $cartItem->quantity * $product->price;
                        @endphp

                        @endif
                        @endforeach
                        @endforeach

                        <h1 class="text-xl mt-4 text-center text-black font-bold border border-white bg-">TOTAL R$: {{ $totalCarrinho }}</h1>


                    </div>

                    <!-- MOSTRAR PRODUTOS -->


                    <br>

                    @foreach (Auth::user()->myCarts as $cartItem)
                    @foreach (App\Models\Product::all() as $product)
                    @if($cartItem->product_id == $product->id)
                    <a href="{{ route('product.show', $product->id) }}">

                        <div class="flex justify-between bg-white border border-lime-300 mb-3 gap-4 hover:bg-lime-100" x-data="{ showEdit: false }">
                            <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">
                            <div class="text-xl mt-2 mb-2">
                                Descrição: {{ $product->description }} <br>
                                Categoria: {{ $product->category }} <br>
                                Vendido por: {{ $product->User->name}} <br>


                                Valor por unidade/kg: R$ {{ $product->price }} <br>
                                Quantidade: {{ $cartItem->quantity }} <br>

                                <div class="border border-green-800 ">
                                    Valor total do produto R$: {{ $cartItem->quantity * $product->price }}
                                </div>
                                <a>
                            </div>

                            <!-- <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;"> -->
                            <div class="mt-5 mr-5 ">
                                <div x-show="!showEdit">
                                    <button @click="showEdit = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">Atualizar</button>
                                </div>
                                <br>

                                <div x-show="showEdit">
                                    <form action="{{ route('cart.update', $cartItem) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <label for="quantity">Quantidade:</label>
                                        <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" max="{{ $product-> stock_product }}" required><br>
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded">Salvar</button>
                                    </form>
                                    <button class="bg-gray-900 hover:bg-gray-500 text-white font-bold py-2 px-3 rounded" @click="showEdit = false">Cancelar</button>

                                </div>

                                <form action="{{ route('cart.destroy', $cartItem) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div x-show="!showEdit">
                                        <x-danger-button class="bg-red-300 hover:bg-red-500">Apagar</x-danger-button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <!-- @php
                    $totalCarrinho += $cartItem->quantity * $product->price;
                    @endphp -->
                        @endif
                        @endforeach
                        @endforeach


                        <br>
                        <!-- <h1 class="text-lg mt-4 text-center font-bold">Valor total do carrinho R$: {{ $totalCarrinho }}</h1> -->
                        <div class="flex justify-end">
                            <form action="{{ route('address.show') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-900 text-center">
                                    <button class="bg-orange-600 text-center text-white text-2xl px-7 py-3 rounded">Finalizar compra</button>
                                </button>
                            </form>
                        </div>
                        <form action="{{ route('cart.empty') }}" method="POST">
                            @csrf
                            <x-primary-button class=" bg-red-500">Esvaziar Carrinho</x-primary-button>
                        </form><br>
                        @else
                        <h1 class="text-lg mt-4 text-center">Você ainda não tem nenhum produto adicionado ao carrinho</h1>
                        <br>
                        <div class="text-center">
                            <a href="{{ route('product.index') }}" class="ml-4 text-xl text-gray-700 dark:text-gray-500 underline">Ver Produtos</a>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
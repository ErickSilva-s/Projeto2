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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl mt-4 font-bold text-center"> Seu carrinho de Compras</h1>

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

                    <div class="flex justify-end">
                        <x-primary-button class="bg-green-900 text-center">Finalizar compra</x-primary-button>
                    </div><br>

                    @foreach (Auth::user()->myCarts as $cartItem)
                    @foreach (App\Models\Product::all() as $product)
                    @if($cartItem->product_id == $product->id)
                    <div class="flex justify-between border-b mb-2 gap-4 hover:bg-gray-300" x-data="{ showEdit: false }">
                        Descrição: {{ $product->description }} <br>
                        Valor por unidade/kg: R$ {{ $product->price }} <br>
                        Categoria: {{ $product->category }} <br>
                        Quantidade: {{ $cartItem->quantity }} <br>
                        Valor total do produto R$: {{ $cartItem->quantity * $product->price }}
                        <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">

                        <div x-show="!showEdit">
                            <button @click="showEdit = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Atualizar</button>
                        </div>


                        <div x-show="showEdit">
                            <form action="{{ route('cart.update', $cartItem) }}" method="POST">
                                @csrf
                                @method('put')
                                <label for="quantity">Quantidade:</label>
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" max="{{ $product-> stock_product }}" required>
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
                            </form>
                        </div>

                        <form action="{{ route('cart.destroy', $cartItem) }}" method="POST">
                            @csrf
                            @method('delete')
                            <x-danger-button class="bg-red-300 hover:bg-red-500">Apagar</x-danger-button>
                        </form>
                    </div>

                    @php
                    $totalCarrinho += $cartItem->quantity * $product->price;
                    @endphp
                    @endif
                    @endforeach
                    @endforeach

                    <br>
                    <h1 class="text-lg mt-4 text-center font-bold">Valor total do carrinho R$: {{ $totalCarrinho }}</h1>

                    <form action="{{ route('cart.empty') }}" method="post">
                        @csrf
                        <x-primary-button>Esvaziar Carrinho</x-primary-button>
                    </form><br>
                    @else
                    <h1 class="text-lg mt-4 text-center">Você ainda não tem nenhum produto adicionado ao carrinho</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

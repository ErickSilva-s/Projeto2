<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl mt-4 text-green-800 font-bold text-center"> A seu pedido foi concluído com sucesso!</h1>

                    <h2 class="text-lg mt-4 text-center"> Obrigado, {{ Auth::user()->name}}, por comprar conosco!</h2><br>

                    <div class="border border-lime-200 bg-white text-lg">
                        <div class="ml-8 mr-8">

                            <div class="mt-4 text-left ml-5">
                                <img src="{{ asset('logo.png') }}" alt="imagem do logotipo" style="width: 150px; margin-right: 0px;">
                                <h1 class="text-xl font-bold ml-4">Feira Na Mão</h1>
                            </div>


                            <h1 class="text-2xl mt-4 text-black font-bold text-center">Resumo do Pedido </h1><br>


                            <!-- NÃO APAGAR ISSO -->
                            @php
                            $totalCarrinho = 0;
                            @endphp

                            <!-- PEGAR O VALOR TOTAL -->

                            @foreach (Auth::user()->myCarts as $cartItem)
                            @foreach (App\Models\Product::all() as $product)
                            @if($cartItem->product_id == $product->id)

                            @php
                            $totalCarrinho += $cartItem->quantity * $product->price;
                            @endphp

                            @endif
                            @endforeach
                            @endforeach

                            <!-- PRA USAR O CHECKOUT -->

                            @foreach (App\Models\Checkout::all() as $index => $checkout)
                            @foreach(Auth::user()->myCheckouts as $checkouts)

                            @endforeach
                            @endforeach

                            <h1>Cliente</h1>
                            <div class="border ml-3">
                                <p>Nome: {{ Auth::user()->name }}</p>
                                <p>Email: {{ Auth::user()->email }}</p>

                            </div><br>

                            <h1>Endereço de Entrega</h1>
                            <div class="border ml-3">
                                <p>CEP:{{$checkouts-> address->cep }}, {{$checkouts-> address->road}}, {{ $checkouts->address->number }},
                                    {{ $checkouts->address->neighborhood}}, Complemento: {{$checkouts-> address->complement}}
                                </p>
                            </div>
                            <br>
                            <h1>Pagamento</h1>
                            <div class="border ml-3">
                                <p>Forma de Pagamento: {{ $checkouts->paymentMethod }}</p>
                                <p>Total a ser pago: R$ {{ $totalCarrinho }}
                                <p>
                            </div><br>

                            <h1>Detalhe dos produtos</h1>

                            @foreach (Auth::user()->myCarts as $cartItem)
                            @foreach (App\Models\Product::all() as $product)
                            @if($cartItem->product_id == $product->id)

                            <div class="border ml-3">
                                <p>Descrição: {{ $product->description }}</p>
                                <p>Categoria: {{ $product->category }}</p>
                                <p>Vendedor: {{ $product->User->name }}</p>
                                <p>Email do vendedor: {{ $product->User->email }}</p>
                                <p>Valor: R$ {{ $product->price }}</p>
                                <p>Quantidade: {{ $cartItem->quantity }}</p> 
                                <p>Valor total do produto: R${{ $cartItem-> quantity * $product->price }}<p>
                                    <p class="text-sm">**Valor calculado com o preço da unidade multiplicado pela quantidade</p>

                            </div><br>

                                    @endif
                                    @endforeach
                                    @endforeach


                                    <h1 class="text-right"> DATA: {{ \Carbon\Carbon::now()->format('d/m/Y') }} </h1>


                                </div>
                            </div><br>
                        <div class="">
                            <div class="text-left">
                                <a href="{{ route('product.index') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 "> <x-primary-button class="bg-green-800">Ver mais produtos</x-primary-button></a>  
                            </div>
                            <div class="text-right mr-8">
                                <x-primary-button class="bg-orange-600">Baixar PDF</x-primary-button>
                            </div>
                        <div>    

                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
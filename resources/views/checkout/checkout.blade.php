<x-app-layout>

    <div class="py-12 bg-green-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-3xl mt-4 center text-black font-bold flex items-center justify-center">
                        Finalizar Compra
                        <img src="{{ asset('meu_carrinho2.png') }}" alt="imagem do carrinho" class="h-7 w-7 ml-2">
                    </h1>
                   
                    <br>
                    <br>



                    <div>
                        <h1 class="text-2xl mt-4  text-green-500 font-bold ">Escolha a forma de pagamento: </h1>
                        

                        <form action=" " method="POST">
                            @csrf
                            <select name="formPagamento" id="formPagamento" required class="block w-full rounded-md border-orange-600 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">>
                                <option value=""> </option>
                                <option value="pix"> Pix </option>
                                <option value="transf_bancaria"> Trasferencia Bancaria</option>

                            </select>
                        </form>

                    </div>


                    <div>
                        <h1 class="text-2xl mt-4  text-green-500 font-bold ">Escolher endereço de entrega: </h1>


                        @if(count(Auth::user()->myAddress) > 0)
                        <!-- <h2 class="text-lg mt-4   text-center">Seus Endereços:</h2> -->

                        <!-- form para retorna para a finalização de compra -->
                        <form action=" " method="POST">
                            @csrf
                            <select name="endereco" id="endereco" required class="block w-full rounded-md border-orange-600 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">>
                                <option value=""> </option>

                                @foreach ($address as $address)
                                <option value="{{ $address->id }}">

                                    <div class="flex justify-between flex-grow px-2 border rounded-md border-green-500">
                                        CEP:{{ $address->cep }}
                                        Rua: {{ $address->road}},
                                        Número: {{ $address->number }},
                                        Bairro: {{ $address->neighborhood}}
                                        Complemento: {{ $address->complement}}
                                    </div>

                                    <br>

                                    @endforeach
                            </select>

                            <br>
                        </form>

                        <div class="text-center">
                            <form action="{{ route('purchase.complete') }}" method="POST">
                                <x-primary-button type="submit" class=" bg-orange-600"> Continuar </x-primary-button>
                            </form>

                        </div>


                        @else

                        <div class="text-center">
                            <h2 class="text-lg font-bold bg-text-black text-center"> Você ainda não tem nenhum endereço cadastrado! <br> Cadastre seu endereço para finalizar seu pedido </h2>

                            <br>

                            <x-primary-button class=" bg-orange-600">
                                <a href="{{ route('dashboard') }}" class="ml-4 text-sm text-white dark:text-gray-500 ">Cadastrar Endereços</a>
                            </x-primary-button>
                        </div>
                        @endif


                        <br>

                    </div>

                    <div class="text-right">
                        <a href="{{ route('cart.index') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
                            Voltar para o carrinho
                            <!-- <img src="{{ asset('meu_carrinho2.png') }}" alt="Ícone do carrinho" class="h-6 w-6"> -->
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
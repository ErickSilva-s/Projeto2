<div class="py-44">
<x-app-layout>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-3xl mt-4 center text-black font-bold flex items-center justify-center">
                        Finalizar Compra
                        <img src="{{ asset('meu_carrinho2.png') }}" alt="imagem do carrinho" class="h-7 w-7 ml-2">
                    </h1>

                    <br>
                    <br>

                    <div>
                        <h1 class="text-xl mt-4  text-green-800 font-bold ">Escolha a forma de pagamento: </h1>

                        <form action="{{ route('checkout.create') }}">
                            @csrf
                            <select name="paymentMethod" id="paymentMethod" required class="block w-full rounded-md border-lime-200 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">>
                                <option  hidden value=""> </option>
                                <option value="pix"> Pix </option>
                                <option value="transf_bancaria"> Transferência Bancaria</option>

                            </select>

                    </div>

                    <!-- <input type="hidden" name="cart_id" id="cart_id" value="{{ Auth::user()->myCarts->first()->id }}"> -->


                    <div>
                        <h1 class="text-xl mt-4  text-green-800 font-bold ">Escolher endereço de entrega: </h1>

                        @if(count(Auth::user()->myAddress) > 0)
                        <!-- <h2 class="text-lg mt-4   text-center">Seus Endereços:</h2> -->
                        <!-- form para retorna para a finalização de compra -->
                        <select name="address_id" id="address_id" required class="block w-full rounded-md border-lime-200 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            <option hidden value=""> </option>
                            @foreach ($address as $address)
                            <option  value="{{ $address->id }}">
                                <div class="flex justify-between flex-grow px-2 border rounded-md border-green-500">
                                    CEP:{{ $address->cep }}
                                    Rua: {{ $address->road}},
                                    Número: {{ $address->number }},
                                    Bairro: {{ $address->neighborhood}}
                                    Complemento: {{ $address->complement}}
                                </div>
                            </option>

                            <br>
                            @endforeach
                        </select>
                        <br>

                        <div class="text-center">
                            <x-primary-button type="submit" class=" bg-orange-600 hover:bg-green-800"> Continuar </x-primary-button>
                            </form>
                        </div>

                        @else
                        <div class="text-center">
                            <h2 class="text-lg font-bold bg-text-black text-center"> Você ainda não tem nenhum endereço cadastrado! <br> Cadastre seu endereço para finalizar seu pedido </h2>
                            <br>
                            <x-primary-button class=" bg-orange-600 hover:bg-green-800">
                                <a href="{{ route('dashboard') }}" class="ml-4 text-sm text-white">Cadastrar Endereços</a>
                            </x-primary-button>
                        </div>
                        @endif
                        <br>

                    </div>

                    <div class="text-right">
                        <a href="{{ route('cart.index') }}" class="ml-4 text-sm text-black underline">
                            Voltar para o carrinho
                            <!-- <img src="{{ asset('meu_carrinho2.png') }}" alt="Ícone do carrinho" class="h-6 w-6"> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

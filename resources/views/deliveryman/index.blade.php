<x-app-layout>
    <x-slot name="header">

        @if(Auth::user())
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Olá, {{ Auth::user()->name }} <br>
        </h2>
        <p> Você está logado com {{ Auth::user()->email }}. <br>
            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-4xl mt-4 font-bold text-center text-black  flex items-center justify-center">
                        <img src="{{ asset('entregador.png') }}" alt="Ícone do entregador" class="h-11 w-11  mr-2 ">
                        Suas Entregas
                    </h1>
                    <br>

                    <h2 class="text-2xl mt-4 font-bold  text-white bg-green-800 flex ">Entregas Disponíveis</h2>
                    <br>

                    <!-- CARROSEL DE PRODUTOS -->

                    <div class="">
                        <div class="max-w-screen mx-auto mt-20 swiper-container">
                            <!-- <h1 class="text-green-800 mt-2 ml-5 text-gl font-semibold">Passe para o lado para conferir mais produtos!!</h1> -->
                            <div class="swiper-wrapper flex">
                                @foreach (App\Models\Checkout::all() as $index => $checkouts )
                                <div class="swiper-slide w-auto">
                                    <div class="swiper-button-next "></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="flex items-center flex-col text-gl  text-black mt-3 mb-2 gap-4 ">
                                        <div class="border border-orange-600 rounded bg-white">
                                            <div class="ml-4 text-xl mr-4">
                                                <h1>Cliente</h1>
                                                <div class="border ml-3">
                                                    <p>Nome: {{ $checkouts->user->name }}</p>
                                                    <p>Email: {{ $checkouts->user->email }}</p>

                                                </div><br>

                                                <h1>Endereço de Entrega</h1>
                                                <div class="border ml-3">
                                                    <p>CEP:{{$checkouts-> address->cep }}, {{$checkouts-> address->road}}, {{ $checkouts->address->number }},
                                                        {{ $checkouts->address->neighborhood}}, Complemento: {{$checkouts-> address->complement}}
                                                    </p>
                                                </div>
                                                <br>
                                                <p class="text-right text-sm mr-5 mb-3 ">{{ $checkouts->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <x-primary-button class="bg-orange-600">Aceitar Entrega</x-primary-button>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                            <br>
                        </div>


                        <!-- SCRIPT DO CARROSEL -->

                        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
                        <script>
                            new Swiper('.swiper-container', {
                                slidesPerView: 1,
                                spaceBetween: 10,
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                            });
                        </script>
                    </div>
                </div>

                <br>
                <h2 class="text-2xl mt-4 font-bold  text-white bg-green-800 flex ">Entregas Realizadas</h2>
                <br>
                <p>
                    aqui vão aparecer as entregas que esse entregador realizou
                </p>


            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
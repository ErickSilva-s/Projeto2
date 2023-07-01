<x-app-layout>

    <x-slot name="header">
        <header class="fixed top-0 left-0 right-0 bg-green-800 py-4 px-6 text-white flex justify-between items-center">
        <div style="display: flex; align-items: center;">
        <a href="{{ url('/') }}">
                <img src="{{ asset('logo2.png') }}" alt="imagem do logotipo" style="width: 170px; margin-right: 0px;">
            <h1 class="text-2xl font-bold ml-4">Feira Na Mão</h1>
</div>
            <nav class="flex space-x-5">
            @if(!(Auth::user()))
                <a href="{{ route('login') }}" class="bg-transparent text-white text-2xl">Entrar</a>
                <!-- como foi conversando com o prof de ihc, é melhor deixar o butão de entrar -->
                <!-- <a href="{{ route('register') }}" class="bg-transparent text-white text-2xl">Cadastre-se</a> -->
                @endif
                <a href="{{ url('/about') }}" class="bg-transparent text-white text-2xl">Sobre</a>
                <a href="{{ url('/product') }}" class="bg-transparent text-white text-2xl">Produtos</a>

            </nav>
        </header>
    </x-slot>
    <!-- Seção de Imagens -->
    <div class="swiper-container mt-28">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="{{ asset('abreu1.jpg') }}" alt="https://abreuelima.pe.gov.br/a-cidade/" class="w-[1900px] h-[600px]">
        </div>
        <div class="swiper-slide">
            <img src="{{ asset('abreu3.jpg') }}" alt="https://abreuelima.pe.gov.br/a-cidade/" class="w-[1900px] h-[600px]">
        </div>
        <div class="swiper-slide">
            <img src="{{ asset('abreu2.jpg') }}" alt="https://abreuelima.pe.gov.br/a-cidade/" class="w-[1900px] h-[600px]">
        </div>

    <div class="swiper-pagination"></div>
</div>
 </div>
<!-- Botões de passar imagens -->
<div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>


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

    <!-- Seção de Ajuda aos Feirantes -->
    <div class="bg-amber-50 py-40">
        <div class="container mx-auto text-center">
            <h2 class="text-left font-bold text-3xl">Apoie os feirantes de sua localidade</h2>
            <br>
            <p class="text-left text-xl">Compre e venda produtos de maneira fácil e rápida.</p>
            <div class="flex mr-0 mt-8">
                <div class="w-1/8">
                    <a href="{{ route('register') }}" class=" bg-orange-500 text-black px-4 py-2 text-center">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>

   <!-- Seção de Produtos -->
<div class="bg-green-800 py-16 mt-0">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4 text-white">Produtos</h2>
        <div class="flex flex-wrap justify-center">
            @foreach (App\Models\Product::limit(3)->get() as $product)
                <div class="w-1/4 p-4">
                    <a href="{{ route('product.show', $product->id) }}">
                    <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">
                    <br>
                    <div class="text-left text-lg font-bold">
                        {{ $product->description }} <br>
                        Valor: R$ {{ $product->price }} <br>
                        Vendido por: {{ $product->User->name}} <br>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{ url('/product') }}" class="bg-orange-500 text-black font-bold px-4 py-2 text-center text-lg">Ver mais produtos</a>
        </div>
    </div>
</div>

<!-- Horarios-->
<div class="bg-amber-50 py-16">
    <div class="container mx-auto text-center">
        <div class="grid grid-cols-2 gap-8">
            <div>
                <h3 class="text-3xl font-bold mb-2">Horário de Funcionamento</h3>
                <p class="text-lg">Seg - Sex: 08hs - 17hs
                    <br>
                    Sábado: 08hs - 14hs
                    <br>
                    Domingo: 08hs - 12hs</p>
            </div>
            <div>
                <h3 class="text-3xl font-bold mb-2">Delivery</h3>
                <p class="text-lg">Seg - Sex: 08hs - 17hs
                    <br>
                    Sábado: 08hs - 14hs
                    <br>
                    Domingo: 08hs - 12hs</p>
            </div>
        </div>
    </div>
</div>
<br>




</x-app-layout>

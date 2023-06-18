<x-app-layout>

    <x-slot name="header">
        <header class="fixed top-0 left-0 right-0 bg-green-800 py-4 px-6 text-white flex justify-between items-center">
            <h1 class="text-2xl font-bold">Feira Na Mão</h1>
            <nav class="flex space-x-5">
                <a href="{{ route('login') }}" class="bg-transparent text-white">Entrar</a>
                <a href="{{ route('register') }}" class="bg-transparent text-white">Cadastre-se</a>
                <a href="{{ url('/about') }}" class="bg-transparent text-white">Sobre</a>
                <a href="{{ url('/product') }}" class="bg-transparent text-white">Produtos</a>
                <a href="{{ url('/product') }}" class="bg-transparent text-white flex items-center"></a>
            </nav>
        </header>
    </x-slot>

    <!-- Seção de Imagens -->
    <div class="bg-gray-200 flex justify-center items-center py-16">
        <div class="container mx-auto">
            <div class="relative">
                <img id="image-slider" src="{{ asset('image1.jpg') }}" alt="Imagem 1" class="max-w-full">
                <div class="absolute top-1/2 left-4 transform -translate-y-1/2">
                    <button onclick="previousImage()" class="bg-transparent text-white text-xl">&#9001;</button>
                </div>
                <div class="absolute top-1/2 right-4 transform -translate-y-1/2">
                    <button onclick="nextImage()" class="bg-transparent text-white text-xl">&#9002;</button>
                </div>
            </div>
            <div class="text-center mt-4">
                <h2 class="text-2xl font-bold">Nome da Imagem</h2>
            </div>
        </div>
    </div>

    <!-- Seção de Ajuda aos Feirantes -->
    <div class="bg-white py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Ajudando os Feirantes</h2>
            <p class="text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend ipsum vel mi elementum tincidunt. In bibendum auctor quam sed sagittis.</p>
            <button class="bg-green-800 text-white px-4 py-2 mt-4">Comprar Agora</button>
        </div>
    </div>

    <!-- Seção de Produtos -->
    <div class="bg-gray-200 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Produtos</h2>
            @foreach (App\Models\Product::all() as $product)

{{ $product-> description }} <br>
Estoque: {{ $product-> stock_product }} <br>
Valor: R$ {{ $product-> price }} <br>
Categoria: {{ $product-> category }} <br>
Vendedido por: {{ $product->User->name}} <br>
<img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">

@endforeach
        </div>
    </div>

    <script>
        // Funções para alternar as imagens
        var images = ['image1.jpg', 'image2.jpg', 'image3.jpg'];
        var currentImageIndex = 0;

        function previousImage() {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            updateImage();
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            updateImage();
        }

        function updateImage() {
            var image = document.getElementById('image-slider');
            image.src = "{{ asset('') }}" + images[currentImageIndex];
        }
    </script>

</x-app-layout>

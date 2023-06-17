<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Feira Na Mão</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
<link href="https://unpkg.com/simplebar@latest/dist/simplebar.min.css" rel="stylesheet" />
<script>
new SimpleBar(document.querySelector('.scroll-container'));
</script>

<style>
.scroll-container {
white-space: nowrap;
}

.overflow-x-scroll {
overflow-x: scroll;
}
</style>
</head>
<body>
<header class="fixed top-0 left-0 right-0 bg-green-800 py-4 px-6 text-white flex justify-between items-center">
<h1 class="text-2xl font-bold">Feira Na Mão</h1>
<nav class="flex space-x-5">
<a href="{{ route('login') }}" class="bg-transparent text-white">Entrar</a>
<a href="{{ route('register') }}" class="bg-transparent text-white">Cadastre-se</a>
<a href="{{ url('/about') }}" class="bg-transparent text-white">Sobre</a>
<a href="{{ url('/product') }}" class="bg-transparent text-white">Produtos</a>
<a href="{{ url('/product') }}" class="bg-transparent text-white flex items-center">
</a>

</a>

</button>
</nav>
</header>

<main class="container mx-auto px-4 py-8">
<section class="mb-8">
<h2 class="text-2xl font-bold mb-4">Onde estamos</h2>
<img src="{{ asset('feira.jpg') }}" alt="imagemfeira" class="w-2/6">
</section>

<div class="bg-gray-200 flex items-center">
<div class="w-1/2">
<h2 class="text-2xl font-bold">Sobre a criação do site</h2>
<br>
<p class="text-sm mb-4 ">
Bem-vindo ao nosso site de compra e venda de produtos de feirantes locais! Nós somos um grupo de estudantes do Instituto Federal de Educação, Ciência e Tecnologia de Pernambuco (IFPE) e estamos animados em trazer uma nova maneira de apoiar os pequenos empreendedores locais. Nosso objetivo é conectar os feirantes da sua comunidade com compradores que valorizam produtos frescos e de qualidade. Nós acreditamos que os feirantes locais são a espinha dorsal das nossas comunidades e estamos dedicados em ajudá-los a expandir seus negócios. Em nosso site, você encontrará uma variedade de produtos frescos e de alta qualidade, como frutas e verduras. Além disso, oferecemos um ambiente seguro e fácil de usar para que você possa comprar e vender com confiança. Estamos comprometidos em apoiar a economia local e esperamos que você se junte a nós nessa missão. Se você é um feirante interessado em vender seus produtos em nosso site. Obrigado por visitar nosso site e esperamos que você aproveite a experiência de comprar e vender produtos locais!
</p>
</div>
<div class="w-1/2">
<img src="{{ asset('feira.jpg') }}" alt="imagemfeira" class=" ml-40">
</div>
</div>

<!-- </section>
<br>
<section class="mb-8 ">
<h2 class="text-2xl font-bold mb-4 flex justify-center">Produtos</h2>
<div class="scroll-container overflow-x-scroll" data-simplebar >
<div class="flex justify-center space-x-4 bg-gray-300" style="width: 1200px">
<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="" alt="Produto 1">
<p class="mt-2">Produto 1</p>
<p class="mt-2">R$ 10,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>

<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem2.jpg" alt="Produto 2">
<p class="mt-2">Produto 2</p>
<p class="mt-2">R$ 20,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>

<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem3.jpg" alt="Produto 3">
<p class="mt-2">Produto 3</p>
<p class="mt-2">R$ 30,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>
<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem3.jpg" alt="Produto 3">
<p class="mt-2">Produto 3</p>
<p class="mt-2">R$ 30,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>
<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem3.jpg" alt="Produto 3">
<p class="mt-2">Produto 3</p>
<p class="mt-2">R$ 30,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>
<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem3.jpg" alt="Produto 3">
<p class="mt-2">Produto 3</p>
<p class="mt-2">R$ 30,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>
<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem3.jpg" alt="Produto 3">
<p class="mt-2">Produto 3</p>
<p class="mt-2">R$ 30,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>
<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem3.jpg" alt="Produto 3">
<p class="mt-2">Produto 3</p>
<p class="mt-2">R$ 30,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>
<section>
<div class="bg-transparent p-4 rounded-lg flex flex-col items-center">
<img src="caminho/para/imagem3.jpg" alt="Produto 3">
<p class="mt-2">Produto 3</p>
<p class="mt-2">R$ 30,00</p>
<div class="mt-4 flex items-center">
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">-</button>
<span class="text-gray-800">1</span>
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">+</button>
</div>
</div>
</section>-->
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

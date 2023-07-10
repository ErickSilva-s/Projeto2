<x-app-layout>
<x-slot name="header">
        <header class="fixed top-0 left-0 right-0 bg-green-800 py-4 px-6 text-white flex justify-between items-center">
        <div style="display: flex; align-items: center;">
        <a href="{{ url('/') }}">
                <img src="{{ asset('logo2.png') }}" alt="imagem do logotipo" style="width: 150px; margin-right: 10px;">
            <h1 class="text-2xl font-bold">Feira Na Mão</h1>
</div>

            @if((Auth::user())) <!--  só mostra o se o usuário estiver logado -->
            <nav class="flex space-x-8">

            @if(!(Auth::user()->type == 'entregador'))
                <a href="{{ url('/product') }}" class="bg-transparent text-white text-2xl">Produtos</a>
                @else
                <a href="{{ url('/deliveries') }}" class="bg-transparent text-white text-2xl">Entregas</a>
                @endif
                @if((Auth::user()->type == 'cliente'))
                <a href="{{ url('/cart') }}" class="bg-transparent text-white  text-2xl">Meu carrinho</a>
                @endif

            </nav>
            @endif

            @if((!Auth::user())) <!--  só mostra o se o usuário não estiver logado -->
            <nav class="flex space-x-10">
                <a href="{{ url('/product') }}" class="bg-transparent text-white text-2xl">Produtos</a>
                <a href="{{ route('login') }}" class="bg-transparent text-white text-2xl">Entrar</a>
            </nav>
            @endif
</header>
    </x-slot>
    <div class="flex">
    <div class="w-1/2 bg-amber-50">
        <div class="h-screen flex justify-center items-center">
            <div class="mx-8 mt-9">
                <h2 class="text-3xl font-bold underline">Sobre a criação do site</h2>
                <br>
                <p class="text-2xl">
                    Bem-vindo ao nosso site de compra e venda de produtos de feirantes locais! Nós somos um grupo de estudantes do Instituto Federal de Educação, Ciência e Tecnologia de Pernambuco (IFPE) e estamos animados em trazer uma nova maneira de apoiar os pequenos empreendedores locais. Nosso objetivo é conectar os feirantes da sua comunidade com compradores que valorizam produtos frescos e de qualidade. Nós acreditamos que os feirantes locais são a espinha dorsal das nossas comunidades e estamos dedicados em ajudá-los a expandir seus negócios. Em nosso site, você encontrará uma variedade de produtos frescos e de alta qualidade, como frutas e verduras. Além disso, oferecemos um ambiente seguro e fácil de usar para que você possa comprar e vender com confiança. Estamos comprometidos em apoiar a economia local e esperamos que você se junte a nós nessa missão. Se você é um feirante interessado em vender seus produtos em nosso site, entre em contato conosco. Obrigado por visitar nosso site e esperamos que você aproveite a experiência de comprar e vender produtos locais!
                </p>
            </div>
        </div>
    </div>

    <div class="flex">
        <div class="w-1/10 bg-green-800 flex justify-center items-center">
            <img src="{{ asset('fazendeiros.png') }}" alt="imagem da fazenda" class="p-40">
        </div>
    </div>
</div>

</x-app-layout>


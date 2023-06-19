<x-app-layout>
    <x-slot name="header">
        <header class="fixed top-0 left-0 right-0 bg-green-800 py-4 px-6 text-white flex justify-between items-center">
            <h1 class="text-2xl font-bold">Feira Na Mão</h1>
            @if(!(Auth::user())) <!--  só mostra o se o usuário não estiver logado -->
            <nav class="flex space-x-5">
                <a href="{{ route('login') }}" class="bg-transparent text-white">Entrar</a>
                <a href="{{ route('register') }}" class="bg-transparent text-white">Cadastre-se</a>
                <a href="{{ url('/about') }}" class="bg-transparent text-white">Sobre</a>
                <a href="{{ url('/product') }}" class="bg-transparent text-white">Produtos</a>
                <a href="{{ url('/product') }}" class="bg-transparent text-white flex items-center"></a>
            </nav>
            @endif
</header>
         @if(Auth::user())  <!-- Se o usuario estiver logado vai aparecer isso:  -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Olá, {{ Auth::user()->name }}! <br>
            </h2>
            <p> Você está logado com {{ Auth::user()->email }}. <br>
                {{ \Carbon\Carbon::now()->format('d/m/Y') }}
            </p>
            @endif

    </x-slot>

    <div class="flex">
        <div class="w-1/2 bg-amber-100">
            <div class="h-screen flex justify-center items-center">
                <div class="mx-8 mt-9">
                    <h2 class="text-2xl font-bold underline">Sobre a criação do site</h2>
                    <br>
                    <p>
                        Bem-vindo ao nosso site de compra e venda de produtos de feirantes locais! Nós somos um grupo de estudantes do Instituto Federal de Educação, Ciência e Tecnologia de Pernambuco (IFPE) e estamos animados em trazer uma nova maneira de apoiar os pequenos empreendedores locais. Nosso objetivo é conectar os feirantes da sua comunidade com compradores que valorizam produtos frescos e de qualidade. Nós acreditamos que os feirantes locais são a espinha dorsal das nossas comunidades e estamos dedicados em ajudá-los a expandir seus negócios. Em nosso site, você encontrará uma variedade de produtos frescos e de alta qualidade, como frutas e verduras. Além disso, oferecemos um ambiente seguro e fácil de usar para que você possa comprar e vender com confiança. Estamos comprometidos em apoiar a economia local e esperamos que você se junte a nós nessa missão. Se você é um feirante interessado em vender seus produtos em nosso site, entre em contato conosco. Obrigado por visitar nosso site e esperamos que você aproveite a experiência de comprar e vender produtos locais!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex">
            <div class="w-1/10 bg-green-800 flex justify-center items-center p-14">

                <img src="{{ asset('fazendeiros.png') }}" alt="imagem da fazenda">


            </div>
        </div>

</x-app-layout>

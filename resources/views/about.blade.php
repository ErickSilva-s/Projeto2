<x-app-layout>
<x-slot name="header">


            @if((Auth::user())) <!--  só mostra o se o usuário estiver logado -->
            <nav class="flex space-x-8">
                <a href="{{ url('/about') }}" class="bg-transparent text-white">Sobre</a>
                <a href="{{ url('/product') }}" class="bg-transparent text-white">Produtos</a>
                <a href="{{ url('/cart') }}" class="bg-transparent text-white">Meu carrinho</a>

            </nav>
            @endif

            @if((!Auth::user())) <!--  só mostra o se o usuário não estiver logado -->
            <nav class="flex space-x-10">
                <a href="{{ url('/product') }}" class="bg-transparent text-white text-2xl">Produtos</a>
                <a href="{{ route('login') }}" class="bg-transparent text-white text-2xl">Entrar</a>
                <a href="{{ route('register') }}" class="bg-transparent text-white text-2xl">Cadastre-se</a>
            </nav>
            @endif

    </x-slot>


    <div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 bg-amber-50">
        <div class="h-screen flex justify-center items-center">
            <div class="mx-8 mt-9">
                <h2 class="text-3xl font-bold underline mb-8">Sobre a criação do site</h2>
                <p class="text-lg md:text-xl">
                    Bem-vindo ao nosso site de compra e venda de produtos de feirantes locais! Nós somos um grupo de estudantes do Instituto Federal de Educação, Ciência e Tecnologia de Pernambuco (IFPE) e estamos animados em trazer uma nova maneira de apoiar os pequenos empreendedores locais. Nosso objetivo é conectar os feirantes da sua comunidade com compradores que valorizam produtos frescos e de qualidade. Nós acreditamos que os feirantes locais são a espinha dorsal das nossas comunidades e estamos dedicados em ajudá-los a expandir seus negócios. Em nosso site, você encontrará uma variedade de produtos frescos e de alta qualidade, como frutas e verduras. Além disso, oferecemos um ambiente seguro e fácil de usar para que você possa comprar e vender com confiança. Estamos comprometidos em apoiar a economia local e esperamos que você se junte a nós nessa missão. Se você é um feirante interessado em vender seus produtos em nosso site, entre em contato conosco. Obrigado por visitar nosso site e esperamos que você aproveite a experiência de comprar e vender produtos locais!
                </p>
            </div>
        </div>
    </div>

    <div class="w-full md:w-1/2 bg-green-800">
        <div class="flex justify-center items-center h-screen">
            <img src="{{ asset('fazendeiros.png') }}" alt="imagem da fazenda" class="p-8 md:p-40">
        </div>
    </div>
</div>

</x-app-layout>


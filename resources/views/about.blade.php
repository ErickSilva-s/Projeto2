<x-app-layout>

    <x-slot name="header">
        @if(!(Auth::user()))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block ">
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Entrar</a>
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Cadastre-se</a>
            <a href="{{ url('/product') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Produtos</a>
        </div>
        @endif

        @if(Auth::user())
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Olá, {{ Auth::user()->name }}!  <br>
        </h2>
        <p> Você está logado com {{ Auth::user()->email }}. <br>
            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>
        @endif

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">



                    <h1 class="text-3xl text-center font-semibold text-orange-600 font-sans"> Sobre </h1>


                </div>
            </div>
        </div>
    </div>




</x-app-layout>

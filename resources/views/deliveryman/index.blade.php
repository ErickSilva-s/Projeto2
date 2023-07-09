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
                    <p> 
                        aqui vão aparecer as entregas que estão disponiveis no momento
                    </p>
                    
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
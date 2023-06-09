<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl mt-4  text-green-500 font-bold text-center"> A sua compra foi concluída com sucesso!</h1>

                    <h2 class="text-lg mt-4   text-center"> Obrigado, {{ Auth::user()->name}}, por comprar conosco!</h2>


                    

                    <div class="text-center">
                        <a href="{{ route('product.index') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Ver mais produtos</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

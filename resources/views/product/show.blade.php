<x-app-layout>
    <x-slot name="header">

        @if(!Auth::user())
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block ">
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Entrar</a>
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Cadastre-se</a>
        </div>
        @endif

        @if(Auth::user())
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Olá, {{ Auth::user()->name }}, veja o produto "{{ $product -> description}}" mais detalhadamente <br>
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
                    <h1 class="text-2xl mt-4 font-bold text-center"> {{ $product -> description}}</h1>
                    <br>

                    @if (session('status'))
                    <div x-data="{show:true}">
                        <div class="p-4 bg-green-300 w-full" x-show="show">
                            {{ session('status') }}
                            <span class="float-right cursor-point" x-on:click="show=false">&times;</span>
                        </div>
                    </div>
                    @endif


                    <div class="flex justify-center ">
                        <div class="flex flex-col">
                            <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 300px; height:auto;">
                        </div>
                        <div class="flex flex-col ml-4 px-2 border rounded-md border-green-900">
                            <h1 class="text-xl mt-4 font-bold">Detalhes do Produto:</h1>

                            <div class="border-b mb-2 hover:bg-gray-300">
                                <p>Descrição: {{ $product->description }}</p>
                            </div>

                            <div class="border-b mb-2 hover:bg-gray-300">
                                <p>Estoque: {{ $product->stock_product }}</p>
                            </div>

                            <div class="border-b mb-2 hover:bg-gray-300">
                                <p>Valor: R$ {{ $product->price }}</p>
                            </div>

                            <div class="border-b mb-2 hover:bg-gray-300">
                                <p>Categoria: {{ $product->category }}</p>
                            </div>

                            <div class="border-b mb-2 hover:bg-gray-300">
                                <p>Vendido por: {{ $product->User->name }}</p>
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @if(Auth::user())
                                @if(Auth::user()->type=='cliente')
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                <x-input-label for="quantity" :value="__('Quantidade')" />

                                <input type="number" name="quantity" value="1" min="1" max="{{ $product-> stock_product }}" required>

                                <x-primary-button>Adicionar ao carrinho</x-primary-button>
                            </form>
                            @endif
                            @endif

                        </div>
                    </div>

                    <h1 class="text-2xl mt-4 font-bold text-center"> Avaliação dos clientes</h1><br>



                    @if(( Auth::user() && Auth::user()->type=='cliente'))

                    <div class="text-center" x-data="{ showForm: false }">
                        <x-primary-button @click="showForm = !showForm">
                            Fazer uma avaliação
                        </x-primary-button>

                        <div x-show="showForm" class="text-center">
                            <form action="{{ route('product.review') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="mt-4">
                                    <x-input-label for="rating" :value="__('Classificação')" />
                                    <select name="rating" required>
                                        <option value="1">1 Estrela</option>
                                        <option value="2">2 Estrelas</option>
                                        <option value="3">3 Estrelas</option>
                                        <option value="4">4 Estrelas</option>
                                        <option value="5">5 Estrelas</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="title" :value="__('Título')" />
                                    <input type="text" name="title" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="comment" :value="__('Comentário')" />
                                    <textarea name="comment" required></textarea>
                                </div>

                                <x-primary-button>Enviar Avaliação</x-primary-button>
                            </form>
                        </div>
                    </div>

                    @endif



                    @if ($product->reviews->count() > 0)
                    @foreach ($product->reviews as $review)
                    <div class="mt-4 text-center">
                        <p>Classificação: {{ $review->rating }} Estrela(s)</p>
                        @if (!empty($review->title))
                        <p>Título: {{ $review->title }}</p>
                        @endif
                        <p>Comentário: {{ $review->comment }}</p>
                        <p>Avaliado por: {{ $review->user->name }}</p>
                        <hr>
                    </div>
                    @endforeach
                    @else
                    <div class="mt-4 text-center">
                        <p>Nenhuma avaliação disponível para este produto.</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

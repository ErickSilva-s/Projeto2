<x-app-layout>

    <head>
        <!-- SCRIPT DO LIKE -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            function likeReview(reviewId) {
                const likeButton = event.target;

                if (likeButton.innerText === 'Like') {
                    axios.post(`/reviews/${reviewId}/like`)
                        .then(response => {
                            if (response.data.success) {
                                const likesCount = document.getElementById(`likesCount${reviewId}`);
                                likesCount.innerText = parseInt(likesCount.innerText) + 1;
                                likeButton.innerText = 'Deslike';
                                likeButton.classList.remove('bg-blue-500');
                                likeButton.classList.add('bg-red-500');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                } else {
                    axios.post(`/reviews/${reviewId}/dislike`)
                        .then(response => {
                            if (response.data.success) {
                                const likesCount = document.getElementById(`likesCount${reviewId}`);
                                likesCount.innerText = parseInt(likesCount.innerText) - 1;
                                likeButton.innerText = 'Like';
                                likeButton.classList.remove('bg-red-500');
                                likeButton.classList.add('bg-blue-500');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            }
        </script>
    </head>

    <x-slot name="header">

            @if(!Auth::user())
            <header class="fixed top-0 left-0 right-0 bg-green-800 py-4 px-6 text-white flex justify-between items-center">
                <div style="display: flex; align-items: center;">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('logo2.png') }}" alt="imagem do logotipo" style="width: 150px; margin-right: 10px;">
                        <h1 class="text-2xl font-bold">Feira Na Mão</h1>
                </div>
                <nav class="flex space-x-10">
                    <a href="{{ route('login') }}" class="bg-transparent text-white text-2xl">Entrar</a>

                    <a href="{{ url('/product') }}" class="bg-transparent text-white text-2xl">Produtos</a>


                </nav>
            </header><br><br><br>
            @endif

        @if(Auth::user())
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Olá, {{ Auth::user()->name }}, veja o produto "{{ $product -> description}}" mais detalhadamente! <br>
        </h2>
        <p> Você está logado com {{ Auth::user()->email }}. <br>
            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>
        @endif
    </x-slot>


    <div class="py-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex">

                        <!-- DIVISÃO DA PAGINA -->
                        <div class="w-1/2 mt-4  bg-transparent flex justify-center items-center">


                            <div class="flex flex-col">
                                <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="max-width: 400px; height:400px;">
                            </div>

                        </div>

                        <!-- DIVISÃO 2 -->
                        <div class="w-1/2 p-12">
                            <h1 class="text-2xl mt-4 font-bold text-center font-sans text-orange-600" style="font-size:30px;">{{ $product->description }}</h1>
                            <br>

                            @if (session('status'))
                            <div x-data="{show:true}">
                                <div class="p-4 bg-green-300 w-full" x-show="show">
                                    {{ session('status') }}
                                    <a class="underline" href="{{ route('cart.index') }}">Ver meu carrinho</a>
                                    <span class="float-right cursor-point" x-on:click="show=false">&times;</span>
                                </div>
                            </div>
                            @endif

                            @if (session('success'))
                            <div x-data="{show:true}">
                                <div class="p-4 bg-green-300 w-full" x-show="show">
                                    {{ session('success') }}
                                    <span class="float-right cursor-point" x-on:click="show=false">&times;</span>
                                </div>
                            </div>
                            @endif

                            @if (session('sent'))
                            <div x-data="{show:true}">
                                <div class="p-4 bg-green-300 w-full" x-show="show">
                                    {{ session('sent') }}
                                    <span class="float-right cursor-point" x-on:click="show=false">&times;</span>
                                </div>
                            </div>
                            @endif

                            <!-- DETALHES DO PRODUTO -->

                            <div class="flex items-center flex-col bg-white ml-5 px-2 border rounded-md">
                                <h1 class="text-2xl mt-4 font-bold font-sans">Detalhes do Produto:</h1>
                                <br>

                                <div class="text-xl mb-2">
                                    <p>Descrição: {{ $product->description }}</p>
                                    </p>

                                    <p>Estoque: {{ $product->stock_product }}</p>

                                    <p>Valor: R${{ $product->price }}</p>

                                    <p>Categoria: {{ $product->category }}</p>

                                    <p>Vendido por: {{ $product->User->name }}</p>
                                </div>

                                <form action="{{ route('cart.add') }}" method="POST">
                                    @if(Auth::user())
                                    @if(Auth::user()->type=='cliente')
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                    <x-input-label for="quantity" class="text-xl text-black font-bold text-center" :value="__('Quantidade')" />

                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product-> stock_product }}" required class="mx-auto block rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">

                                    <br>
                                    <div class="flex justify-center">
                                        <x-primary-button class="flex justify-center bg-green-900 hover:bg-orange-600">Adicionar ao carrinho</x-primary-button>
                                    </div>

                                    <br>
                                </form>
                            </div>
                            @endif
                            @endif

                        </div>
                    </div>
                </div>

                <!-- CARROSEL DE PRODUTOS --><br>
                <p class="text-white bg-green-800 mt-2 ml-5 text-xl text-center font-semibold">Passe para o lado para conferir mais produtos!!</p><br>
                <div class="bg-transparent mt-20" style="overflow: hidden;">
                    <div class="max-w-screen mx-auto relative">
                        <div class="swiper-container">
                            <div class="swiper-wrapper flex">
                                @foreach (App\Models\Product::all() as $index => $product2)
                                <div class="swiper-slide w-auto">
                                    <div class="flex flex-col items-center text-gl text-black mt-3 mb-2 gap-4">
                                        <a href="{{ route('product.show', $product2->id) }}" class="flex flex-col items-center">
                                            <img src="{{ asset('/img/imgProduct/' . $product2->imagem) }}" alt="Imagem do Produto" style="max-width: 400px; height:200px; position: sticky">
                                            <div class="mt-4 text-center">
                                                <p class="text-xl">Descrição: {{ $product2->description }}</p>
                                                <p class="text-xl">Vendido por: {{ $product2->User->name }}</p>
                                                <p class="text-xl">Valor: R${{ $product2->price }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next absolute top-1/2 right-0 transform -translate-y-1/2"></div>
                            <div class="swiper-button-prev absolute top-1/2 left-0 transform -translate-y-1/2"></div>
                        </div>
                    </div>
                </div>

                <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
                <script>
                    new Swiper('.swiper-container', {
                        slidesPerView: 2,
                        spaceBetween: 10,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                </script>



                <!-- AVALIAÇÃOES -->

                <div class="bg-amber-50">
                    <br>
                    <h1 class="text-3xl mt-5  text-center text-green-800 font-semibold underline"> Avaliações dos clientes </h1>
                    <br>

                    <!-- FAZER AVALIAÇÃO -->

                    @if(( Auth::user() && Auth::user()->type=='cliente'))

                    <p class="text-center text-green-800 text-xl"> Diga-nos o que você achou desse produto e confira as avaliações de outros usuários!</p> <br>


                    <div class="text-center" x-data="{ showForm: false }">
                        <x-primary-button class=" bg-orange-600 hover:bg-green-800" @click="showForm = !showForm">
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
                                    <input type="text" name="title" style="width: 500px; height:50px;" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="comment" :value="__('Comentário')" />
                                    <textarea name="comment" style="width: 500px; height:100px;" required></textarea>
                                </div>

                                <x-primary-button class="bg-green-900 hover:bg-orange-500">Enviar Avaliação </x-primary-button>
                            </form>
                        </div>
                    </div>
                    @endif

                    <!-- LISTAR AVALIAÇÕES -->

                    <div class="bg-amber-50">

                        @if ($product->reviews->count() == 0)
                        <div class="mt-4 text-center">
                            <p>Nenhuma avaliação disponível para este produto.</p>
                        </div>
                        @else
                        @foreach ($product->reviews as $review)
                        @if ($review->product_id == $product->id)

                        <div class="mt-4 ml-5 mr-5 mb-4" x-data="{ showDelete: false, likesCount: parseInt('{{ $review->likes }}'), liked: false }" x-init="liked = localStorage.getItem(`liked_${{ $review->id }}`) === 'true'">

                            <div class="border bg-white ml-6">

                                <p class="font-semibold ml-6" style="font-size:20px;">{{ $review->title}}</p>
                                <p class="flex items-center">
                                    Classificação: <span class="ml-2">{{ $review->rating }}</span>
                                    <img src="{{ asset('estrelinha.png') }}" alt="Ícone da estrelinha" class="h-7 w-7">

                                </p>
                                <p>Comentário: {{ $review->comment }}</p>
                                <p>Avaliado por: {{ $review->user->name }}</p>
                                <p><span class="ml-2 text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span></p>

                                <!-- CURTIDAS -->

                                <p class="flex items-center">
                                    <img src="{{ asset('cora_verm.png') }}" alt="Ícone do coração" class="h-7 w-7">
                                    <span x-text="likesCount" x-bind:id="'likesCount{{ $review->id }}'" class="ml-1"></span>
                                </p>

                                <template x-if="!liked">
                                    <button @click="likeReview('{{ $review->id }}')" class="bg-blue-500 text-white px-4 py-2 rounded">
                                        Like
                                    </button>
                                </template>

                                <template x-if="liked">
                                    <button @click="likeReview('{{ $review->id }}')" class="bg-red-500 text-white px-4 py-2 rounded">
                                        Deslike
                                    </button>
                                </template>


                                <!-- DELETAR AVALIAÇÃO -->

                                @if(Auth::user())
                                @if(Auth::user()->type == 'administrador' || Auth::user()->id == $review->user_id)
                                <div class="flex gap-2">
                                    <div class="flex justify-between items-center w-full">
                                        <div></div>
                                        <div class="mb-3">
                                            <span class="cursor-pointer border rounded-md px-2 bg-red-500 text-white" @click="showDelete = true">Apagar Avaliação</span>
                                        </div>
                                    </div>
                                    <hr>
                                </div>


                                <template x-if="showDelete">
                                    <div class="fixed inset-0 flex items-center justify-center z-50">
                                        <div class="absolute inset-0 bg-gray-800 bg-opacity-20"></div>
                                        <div class="w-96 bg-white p-4 relative z-10">
                                            <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                            <form action="{{ route('review.destroy', $review) }}" method="POST">
                                                @csrf
                                                @method('delete')


                                                <x-danger-button class="bg-red-300 hover:bg-red-500">Apagar </x-danger-button>

                                            </form>
                                            <x-primary-button class="w-full" @click="showDelete = false">Cancelar</x-primary-button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            @endif
                            @endif
                        </div>

                    </div>
                    @endif
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </div>
    </div>

</x-app-layout>

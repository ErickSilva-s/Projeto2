<x-app-layout>

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

            </nav>
        </header><br><br><br>
        @endif


        @if(Auth::user())
        Olá, {{ Auth::user()->name }}! Seja bem vindo ({{ Auth::user()->type }}) <br>
        </h2>
        <p> Você está logado com {{ Auth::user()->email }}. <br>
            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>
        @endif
    </x-slot>

    <div class="py-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">



                    <h1 class="text-center font-semibold text-orange-600 font-sans" style="font-size:40px;"> Produtos </h1> <br>

                    @if(Auth::user())
                    @if (Auth::user()->type=='vendedor')
                    <fieldset class="border p-2 mb-2 border-black rounded">
                        <legend class="px-2 border rounded-md border-black" style="font-size:20px;">Adicionar novo produto</legend>
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-2 grid-cols-2 mb-2 ">
                                <div class="mt-4">
                                    <x-input-label for="description" :value="__('Descrição')" />
                                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="stock_product" :value="__('Estoque')" />
                                    <x-text-input id="stock_product" class="block mt-1 w-full" type="number" name="stock_product" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="price" :value="__('Preço')" />
                                    <x-text-input id="price" class="block mt-1 w-full " type="number" step="0.01" name="price" required />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="category" :value="__('Categoria')" class="text-lg"></x-input-label>
                                    <select required name="category">

                                        <option value=""> -- Selecione -- </option>
                                        <option value="grao">Grão</option>
                                        <option value="fruta">Fruta</option>
                                        <option value="verdura">Verdura</option>
                                        <option value="raiz">Raiz</option>
                                        <option value="Hortalicas">Hortaliças</option>
                                        <option value="legumes">Legumes</option>
                                        <option value="tempero">Temperos</option>
                                        <option value="outro">Outro</option>
                                    </select>
                                </div>

                                <div class="mt-6">
                                    <x-input-label for="imagem" :value="__('Imagem do Produto')" />
                                    <input id="imagem" class="form-control-file" type="file" name="imagem" required />

                                    <br>
                                    <br>
                                    @if($errors->has('imagem'))
                                    <div class="alert alert-danger  px-2 border rounded-md border-green-900 bg-red-300">
                                        {{ $errors->first('imagem') }}
                                    </div>
                                    @endif

                                    <br>

                                    @if(session('success'))
                                    <div class="alert alert-success px-2 border rounded-md bg-orange-500 text-white text-lg  ">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                </div>
                            </div>

                            <div class="flex justify-center mt-8">
                                <x-primary-button class="bg-green-900 hover:bg-orange-600 text-center w-48 justify-center ">
                                    Adicionar
                                </x-primary-button>
                            </div>
                        </form>
                    </fieldset>

                    @endif
                    @endif

                    <div class="text-center">
                        <form action="{{ route('product.index') }}" method="GET">
                            <input type="text" name="pesquisa" placeholder="Pesquisar produtos" value="{{ $pesquisa ?? '' }}" class="bg-white">
                            <button type="submit" class="bg-green-900 hover:bg-orange-400 text-white py-2 px-4 rounded-md">Pesquisar</button>
                        </form>
                        @if (!empty($pesquisa))
                        <div class="border rounded-md border-orange-500 mt-4 font-bold">
                            @if ($products->count() > 0)
                            @foreach ($products as $product)
                            <a href="{{ route('product.show', $product->id) }}" class="block p-4 hover:bg-green-100">
                                <div>
                                    {{ $product->description }} (R$ {{ $product->price }})
                                </div>
                            </a>
                            @endforeach
                            @else
                            <p class="p-4">Nenhum resultado encontrado.</p>
                            @endif
                        </div>
                        @endif
                    </div><br>


                    @if(!Auth::user())

                    @foreach (App\Models\Product::all() as $product)
                    @if(!Auth::user())
                    <a href="{{ route('product.show', $product->id) }}">
                        <div class="flex flex-col items-center border-black p-6 mb-2 gap-4 hover:bg-lime-200">
                            <div class="flex flex-col items-center">
                                <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" class="w-48 h-100 mb-4">
                                <div>
                                    <span class="font-bold text-lg">Descrição:</span> {{ $product->description }}
                                </div>
                                <div>
                                    <span class="font-bold text-lg">Estoque:</span> {{ $product->stock_product }}
                                </div>
                                <div>
                                    <span class="font-bold text-lg">Valor:</span> R$ {{ $product->price }}
                                </div>
                                <div>
                                    <span class="font-bold text-lg">Vendido por:</span> {{ $product->User->name }}
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif

                    @endforeach
                    @endif


                    @if (session('status'))
                    <div x-data="{show:true}">
                        <div class="p-4 bg-green-300 w-full" x-show="show">
                            {{ session('status') }}
                            <a class="underline" href="{{ route('cart.index') }}">Ver meu carrinho</a>
                            <span class="float-right cursor-point" x-on:click="show=false">&times;</span>
                        </div>
                    </div>
                    @endif


                    @if(Auth::user())
                    @if(!((Auth::user()->type=='vendedor') || (Auth::user()->type=='entregador')))
                    <h2 class="text-lg font-bold bg-text-black text-center"> Produtos cadastrados: </h2>


                    @foreach (App\Models\Product::all() as $product)

                    <div>
                        <a href="{{ route('product.show', $product->id) }}">
                            <div class="flex justify-between border-b mb-2 gap-4
                    hover:bg-green-100" x-data=" { showDelete: false, showEdit: false  } ">

                                <div class="flex justify-between flex-grow" href="{{ route('product.show', $product->id) }}">

                                    <a href="{{ route('product.show', $product->id) }}">
                                        <div class="flex justify-center border-b mb-2 gap-4">
                                            <div class="flex flex-col items-center"><br><br>
                                                <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" class="w-48 h-100 mb-4">
                                                <div>
                                                    <span class="font-bold text-lg">Descrição:</span> {{ $product->description }}
                                                </div>
                                                <div>
                                                    <span class="font-bold text-lg">Estoque:</span> {{ $product->stock_product }}
                                                </div>
                                                <div>
                                                    <span class="font-bold text-lg">Valor:</span> R$ {{ $product->price }}
                                                </div>
                                                <div>
                                                    <span class="font-bold text-lg">Vendido por:</span> {{ $product->User->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>



                                    @if(Auth::user()->type=='cliente')
                                    <div class="mt-28">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                            <x-input-label for="quantity" :value="__('Quantidade')" />

                                            <input type="number" name="quantity" value="1" min="1" max="{{ $product-> stock_product }}" required>

                                            <x-primary-button class="bg-green-800 hover:bg-orange-500">Adicionar ao carrinho</x-primary-button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                                @endif
                            </div>


                        @if(( Auth::user() && Auth::user()->type=='administrador'))
                        <div class="flex gap-2">
                            <div>
                                <span class="cursor-pointer border rounded-md  px-2 bg-red-500 text-white" @click="showDelete = true ">Apagar</span>
                            </div>

                            <!-- <div>
                            <span class="cursor-pointer px-2 bg-blue-500 border rounded-md text-white" @click="showEdit = true ">Editar </span>
                        </div>-->


                        </div>





                        <template x-if="showDelete">
                            <div class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20"></div>
                                <div class="w-96 bg-white p-4 relative z-10">
                                    <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                    <div class="flex justify-center">
                                        <form action="{{ route('product.destroy', $product) }}" method="POST">
                                            <br>
                                            @csrf
                                            @method('delete')
                                            <x-danger-button class="bg-red-300 hover:bg-red-500">Apagar</x-danger-button>
                                        </form>
                                    </div>
                                    <div class="flex justify-center mt-2">
                                        <x-primary-button class="bg-blue-500" @click="showDelete = false">Cancelar</x-primary-button>
                                    </div>
                        </template>
                    </div>
                    @endif




                    @endforeach
                    @endif
                    @endif



                    @if(Auth::user())
                    @if((Auth::user()->type=='vendedor'))
                    @if(count(Auth::user()->myProducts) > 0)

                    <h1 class="text-lg mt-4 font-bold text-center" style="font-size:18px;"> Seus produtos cadastrados </h1>

                    @foreach (Auth::user()->myProducts as $product)
                    <div class="flex justify-between border-b mb-2 gap-4 mt-10
                    hover:bg-green-100" x-data=" { showDelete: false, showEdit: false  } ">
                        <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">
                        <a href="{{ route('product.show', $product->id) }}">
                            <div class="flex justify-between flex-grow font-bold mb-6">
                                Descrição: {{ $product-> description }} <br>
                                Estoque: {{ $product-> stock_product }} <br>
                                Valor: R$ {{ $product-> price }} <br>
                                Categoria: {{ $product-> category }} <br>
                                Vendido por: {{ $product->User->name}} <br>



                            </div>
                        </a>

                        <div class="flex gap-2 mt-10 mr-5">
                            <div>
                                <span class="cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded" @click="showDelete = true ">Apagar</span>
                            </div>
                            <div>
                                <span class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded" @click="showEdit = true ">Editar </span>
                            </div>
                        </div>

                        <template x-if="showDelete">
                            <div class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20"></div>
                                <div class="w-96 bg-white p-4 relative z-10 flex flex-col items-center">
                                    <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                    <form action="{{ route('product.destroy', $product) }}" method="POST"><br>
                                        @csrf
                                        @method('delete')
                                        <x-danger-button class="bg-red-300 hover:bg-red-500">Apagar</x-danger-button>
                                    </form>
                                    <x-primary-button class=" mt-2" @click="showDelete = false">Cancelar</x-primary-button>
                                </div>
                            </div>
                        </template>



                        <template x-if="showEdit">
                            <div class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20"></div>
                                <div class="w-96 bg-white p-4 relative z-10">
                                    <h2 class="text-xl font-bold text-center">{{ $product->description }} | R$: {{ $product->price }}</h2>
                                    <form class="my-4" action="{{ route('product.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label for="description" class="block mb-2">Descrição:</label>
                                            <x-text-input name="description" id="description" placeholder="Descrição" value="{{ $product->description }}" required></x-text-input>
                                        </div>
                                        <div class="mb-4">
                                            <label for="stock_product" class="block mb-2">Estoque:</label>
                                            <x-text-input name="stock_product" id="stock_product" placeholder="Estoque" value="{{ $product->stock_product }}" required></x-text-input>
                                        </div>
                                        <div class="mb-4">
                                            <label for="price" class="block mb-2">Preço:</label>
                                            <x-text-input name="price" id="price" placeholder="Preço" value="{{ $product->price }}" required></x-text-input>
                                        </div>
                                        <div class="mb-4">
                                            <label for="category" class="block mb-2">Categoria:</label>
                                            <x-text-input name="category" id="category" placeholder="Categoria" value="{{ $product->category }}" required></x-text-input>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <x-primary-button class="bg-blue-600">Editar</x-primary-button>
                                            <x-primary-button @click="showEdit = false" class="mt-2">Cancelar</x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </template>



                    </div>

                    @endforeach
                    @else
                    <h1 class="text-lg font-bold bg-text-black text-center"> Você ainda não tem nenhum produto cadastrado! </h1>
                    @endif
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

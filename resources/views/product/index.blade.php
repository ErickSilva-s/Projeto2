
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
            Olá, {{ Auth::user()->name }}! ({{ Auth::user()->type }}) <br>
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



                    <h1  class="text-center font-semibold text-orange-600 font-sans" style="font-size:30px;"> Produtos </h1> <br>

                    @if(Auth::user())
                    @if (Auth::user()->type=='vendedor')
                    <fieldset class="border p-2 mb-2 border-black rounded">
                        <legend class="px-2 border rounded-md border-black" style="font-size:18px;">Adicionar novo produto</legend>
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


                                <div class="mt-4">
                                    <x-input-label for="imagem" :value="__('Imagem do Produto')" />
                                    <input id="imagem" class="form-control-file" type="file" name="imagem" required />

                                    <br>

                                    @if($errors->has('imagem'))
                                    <div class="alert alert-danger  px-2 border rounded-md border-green-900 bg-red-300">
                                        {{ $errors->first('imagem') }}
                                    </div>
                                    @endif

                                    <br>

                                    @if(session('success'))
                                    <div class="alert alert-success px-2 border rounded-md border-green-900 bg-green-300  ">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                </div>





                            </div>

                            <x-primary-button class="w-full bg-green-900">Adicionar</x-primary-button>
                        </form>
                    </fieldset>

                    @endif
                    @endif

                    <div class="text-center">
                        <form action="{{ route('product.index') }}" method="GET">
                            <input type="text" name="pesquisa" placeholder="Pesquisar produtos" value="{{ $pesquisa ?? '' }}">
                            <x-primary-button class="bg-green-900 ">Pesquisar</x-primary-button>
                        </form>
                        @if (!empty($pesquisa))
                        <div class="border rounded-md border-green-500">
                            @if ($products->count() > 0)
                            @foreach ($products as $product)
                            <div>
                                <a href="{{ route('product.show', $product->id) }}">
                                    {{ $product->description }} (R$ {{ $product->price }})
                            </div>
                            @endforeach
                            @else
                            <p>Nenhum resultado encontrado.</p>
                            @endif
                        </div>
                        @endif
                    </div><br>

                    @if(!Auth::user())

                    @foreach (App\Models\Product::all() as $product)
                    @if(!Auth::user())

                <a href="{{ route('product.show', $product->id) }}">
                    <div class="flex justify-between border-b mb-2 gap-4
                        hover:bg-gray-300">
                        Descrição: {{ $product-> description }} <br>
                        Estoque: {{ $product-> stock_product }} <br>
                        Valor: R$ {{ $product-> price }} <br>
                        Categoria: {{ $product-> category }} <br>
                        Vendedido por: {{ $product->User->name}} <br>
                        <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">
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


                    <div class="flex justify-between border-b mb-2 gap-4
                    hover:bg-gray-300" x-data=" { showDelete: false, showEdit: false  } ">

                    <a href="{{ route('product.show', $product->id) }}">
                        <div class="flex justify-between flex-grow">

                            Descrição: {{ $product-> description }} <br>
                            Estoque: {{ $product-> stock_product }} <br>
                            Valor: R$ {{ $product-> price }} <br>
                            Categoria: {{ $product-> category }} <br>
                            Vendido por: {{ $product->User->name}} <br>
                            <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">

                        <!-- <br> -->
                            <form action="{{ route('cart.add') }}" method="POST">
                                @if(Auth::user()->type=='cliente')
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                <x-input-label for="quantity" :value="__('Quantidade')" />

                                <input type="number" name="quantity" value="1" min="1" max="{{ $product-> stock_product }}" required>

                                <x-primary-button class=" bg-green-900">Adicionar ao carrinho</x-primary-button>
                            </form>
                            @endif
                        </div>
                    </a>



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
                            <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">
                                    <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                    <form action="{{ route('product.destroy', $product )}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <x-danger-button class="bg-red-300 hover:bg-red-500"> Apagar </x-danger-button>
                                    </form>
                                    <x-primary-button class="w-full" @click="showDelete = false">Cancelar</x-primary-button>
                                </div>
                            </div>
                    </div>
                    </template>

                    <!--
                <template x-if="showEdit">
                    <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                        <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">
                            <h2 class="text-xl font-bold text-center">{{ $product ->description }} | {{ $product->price}} </h2>
                            <form class="my-4" action=" {{ route('product.destroy', $product) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <x-text-input name="description" placeholder="Descrição" value="{{ $product->description }}" required></x-text-input>
                                <x-text-input name="stock_product" placeholder="Estoque" value="{{ $product->stock_product }}" required></x-text-input>
                                <x-text-input name="price" placeholder="Preço" value="{{ $product->price }}" required></x-text-input>
                                <x-text-input name="category" placeholder="Categoria" value="{{ $product->category }}" required></x-text-input>
                                <x-primary-button>Editar</x-primary-button>
                            </form>
                            <x-primary-button @click="showEdit = false" class="w-full">Cancelar</x-primary-button>
                        </div>
                    </div>
                </template>

            </div>-->

                    @endif

                </div>


                @endforeach
                @endif
                @endif



                @if(Auth::user())
                @if((Auth::user()->type=='vendedor'))
                @if(count(Auth::user()->myProducts) > 0)

                <h1 class="text-lg mt-4 font-bold text-center" style="font-size:18px;"> Seus produtos cadastrados </h1>

                @foreach (Auth::user()->myProducts as $product)
                <div class="flex justify-between border-b mb-2 gap-4
                    hover:bg-gray-300" x-data=" { showDelete: false, showEdit: false  } ">

                <a href="{{ route('product.show', $product->id) }}">
                    <div class="flex justify-between flex-grow">
                        Descrição: {{ $product-> description }} <br>
                        Estoque: {{ $product-> stock_product }} <br>
                        Valor: R$ {{ $product-> price }} <br>
                        Categoria: {{ $product-> category }} <br>
                        Vendido por: {{ $product->User->name}} <br>
                        <img src="{{ asset('/img/imgProduct/' . $product->imagem) }}" alt="Imagem do Produto" style="width: 200px; height:auto;">


                    </div>
                </a>

                    <div class="flex gap-2">
                        <div>
                            <span class="cursor-pointer px-2 bg-red-500 text-white" @click="showDelete = true ">Apagar</span>
                        </div>
                        <div>
                            <span class="cursor-pointer px-2 bg-blue-500 text-white" @click="showEdit = true ">Editar </span>
                        </div>
                    </div>

                    <template x-if="showDelete">
                        <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                            <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">
                                <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                <form action="{{ route('product.destroy', $product )}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <x-danger-button class="bg-red-300 hover:bg-red-500"> Apagar </x-danger-button>
                                </form>
                                <x-primary-button class="w-full" @click="showDelete = false">Cancelar</x-primary-button>
                            </div>
                        </div>
                </div>
                </template>

                <template x-if="showEdit">
                    <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                        <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">
                            <h2 class="text-xl font-bold text-center">{{ $product ->description }} | {{ $product->price}} </h2>
                            <form class="my-4" action=" {{ route('product.destroy', $product) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <x-text-input name="description" placeholder="Descrição" value="{{ $product->description }}" required></x-text-input>
                                <x-text-input name="stock_product" placeholder="Estoque" value="{{ $product->stock_product }}" required></x-text-input>
                                <x-text-input name="price" placeholder="Preço" value="{{ $product->price }}" required></x-text-input>
                                <x-text-input name="category" placeholder="Categoria" value="{{ $product->category }}" required></x-text-input>
                                <x-primary-button>Editar</x-primary-button>
                            </form>
                            <x-primary-button @click="showEdit = false" class="w-full">Cancelar</x-primary-button>
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



<x-app-layout>
    <x-slot name="header">


        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">


            @if(Auth::user())

            Olá, {{ Auth::user()->name }}! <br>

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

                    <h1 class="text-lg mt-4 font-bold text-center" style="font-size:24px;"> Produtos </h1>




                     @if(Auth::user())
                    @if(Auth::user()->is_admin || (Auth::user()->is_vendedor))
                    <fieldset class="border p-2 mb-2 border-black rounded">
                        <legend class="px-2 border rounded-md border-black" style="font-size:18px;">Adicionar novo produto</legend>
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf
                            <div class="grid gap-2 grid-cols-2 mb-2 ">
                                <div class="mt-4">
                                    <x-input-label for="description"  :value="__('Descrição')"/>
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
                                         <option value="ortalicas">Ortaliças</option>
                                         <option value="legumes">Legumes</option>
                                         <option value="tempero">Temperos</option>
                                     </select>
                                 </div>
                            </div>

                            <x-primary-button class="w-full bg-green-900">Adicionar</x-primary-button>
                        </form>
                    </fieldset>


                    <h2 class="text-lg font-bold"> Produtos cadastrados: </h2>

                    @endif
                    @endif

                    <div>
                        <form action="{{ route('product.index') }}" method="GET">
                            <input type="text" name="pesquisa" placeholder="Pesquisar produtos">
                            <x-primary-button class="git bg-green-900">Pesquisar</x-primary-button>

                        </form>

                        <div class=" border rounded-md border-green-500">
                            @foreach ($product as $prod)
                            <p>{{ $prod->description }} ( R$ {{ $prod->price }})</p>
                            @endforeach
                        </div>

                    </div>




                    @foreach (App\Models\Product::all() as $product)


                    <div class="flex justify-between border-b mb-2 gap-4
                    hover:bg-gray-300" x-data=" { showDelete: false, showEdit: false  } ">

                        <div class="flex justify-between flex-grow">
                            @if(!Auth::user() || (Auth::user() ->is_admin) || (Auth::user() ->is_cliente)  && (Auth::user() ->is_cliente) &&  (!Auth::user()->is_vendedor))

                            Descrição: {{ $product-> description }} <br>
                            Estoque: {{ $product-> stock_product }} <br>
                            Valor: R$ {{ $product-> price }} <br>
                            Categoria: {{ $product-> category }}
                            @endif
                        </div>

                        @if(( Auth::user() && Auth::user()->is_admin))
                        <div class="flex gap-2">
                            <div>
                                <span class="cursor-pointer border rounded-md  px-2 bg-red-500 text-white" @click="showDelete = true ">Apagar</span>
                            </div>
                            <div>
                                <span class="cursor-pointer px-2 bg-blue-500 border rounded-md text-white" @click="showEdit = true ">Editar </span>
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

                @endif
                @endforeach


                @if(Auth::user())
                @foreach (Auth::user()->myProducts as $product)
                @if((Auth::user()->is_vendedor))
                <div class="flex justify-between border-b mb-2 gap-4
                    hover:bg-gray-300" x-data=" { showDelete: false, showEdit: false  } ">

                    <div class="flex justify-between flex-grow">
                        Descrição: {{ $product-> description }} <br>
                        Estoque: {{ $product-> stock_product }} <br>
                        Valor: R$ {{ $product-> price }} <br>
                        Categoria: {{ $product-> category }}
                    </div>


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

            @endif
            @endforeach
            @endif


        </div>
    </div>
    </div>
    </div>

</x-app-layout>
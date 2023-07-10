<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Endereços')}}  -->

            Olá, {{ Auth::user()->name }}! <br>

        </h2>
        <p> Você está logado com {{ Auth::user()->email }}. <br>
            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>

    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl mt-4 font-bold text-center font-sans text-orange-600" style="font-size:30px;"> Endereços </h1>

                    <br>
                    <fieldset class="border p-2 mb-2 border-black rounded">
                        <legend class="px-2 border rounded-md border-black">Adicionar novo endereço</legend>
                        <form action="{{ route('address.store')  }}" method="POST">
                            @csrf
                            <div class="grid gap-2 grid-cols-2 mb-2">
                                <div class="mt-4">
                                    <x-input-label for="number" :value="__('Número')" />
                                    <x-text-input id="number" class="block mt-1 w-full " type="number" name="number" required />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="road" :value="__('Logradouro')" />
                                    <x-text-input id="road" class="block mt-1 w-full" type="text" name="road" required />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="cep" :value="__('Cep')" />
                                    <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" required />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="neighborhood" :value="__('Bairro')" />
                                    <x-text-input id="neighborhood" class="block mt-1 w-full" type="text" name="neighborhood" required />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="complement" :value="__('Complemento')" />
                                    <x-text-input id="complement" class="block mt-1 w-full" type="text" name="complement" />
                                </div>
                            </div>

                            <div class="flex justify-center mt-8">
                                <x-primary-button class="bg-green-900 hover:bg-orange-600 text-center w-48 justify-center ">
                                    Adicionar
                                </x-primary-button>
                            </div>


                        </form>
                    </fieldset>
                    <br>

                    @if(count(Auth::user()->myAddress) > 0)

                    <h2 class="text-xl font-bold bg-text-black text-center"> Seus Endereços cadastrados: </h2> <br>

                    @foreach(Auth::user()->myAddress as $address)

                    <div class="flex justify-between border-b mb-2 gap-4
                    hover:bg-gray-300" x-data=" { showDelete: false, showEdit: false  } ">

                        <div class="flex justify-between flex-grow px-2 border rounded-md border-green-500 text-xl">
                            Nome:{{ Auth::user()->name }}<br>
                            Cep:{{ $address->cep }}<br>
                            Rua: {{ $address->road}}, {{ $address->number }}, {{ $address->neighborhood}}<br>
                            Complemento: {{ $address->complement}}

                            <div class="flex flex-col gap-2">
                                <div class="mt-4">
                                    <span class="cursor-pointer px-5 bg-blue-500 hover:bg-blue-300 border rounded-md text-white" @click="showEdit = true">Editar</span>
                                </div>
                                <div>
                                    <span class="cursor-pointer px-4 bg-red-500 border rounded-md text-white" @click="showDelete = true">Apagar</span>
                                </div>

                            </div>


                        </div>


                        <template x-if="showDelete">
                            <div class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20"></div>
                                <div class="w-96 bg-white p-4 relative z-10">
                                    <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                    <div class="flex justify-center">
                                        <form action="{{ route('address.destroy',  $address) }}" method="POST">
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
                        <template x-if="showEdit">
                            <div class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20"></div>
                                <div class="w-96 bg-white p-4 relative z-10">
                                    <h2 class="text-xl font-bold text-center">{{ $address->road }} | {{ $address->number }}</h2>
                                    <form class="my-4" action="{{ route('address.update', $address) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label for="road" class="block mb-2">Logradouro:</label>
                                            <x-text-input name="road" id="road" placeholder="Logradouro" value="{{ $address->road }}" required></x-text-input>
                                        </div>
                                        <div class="mb-4">
                                            <label for="number" class="block mb-2">Número:</label>
                                            <x-text-input name="number" id="number" placeholder="Número" value="{{ $address->number }}" required></x-text-input>
                                        </div>
                                        <div class="mb-4">
                                            <label for="cep" class="block mb-2">CEP:</label>
                                            <x-text-input name="cep" id="cep" placeholder="CEP" value="{{ $address->cep }}" required></x-text-input>
                                        </div>
                                        <div class="mb-4">
                                            <label for="neighborhood" class="block mb-2">Bairro:</label>
                                            <x-text-input name="neighborhood" id="neighborhood" placeholder="Bairro" value="{{ $address->neighborhood }}" required></x-text-input>
                                        </div>
                                        <div class="mb-4">
                                            <label for="complement" class="block mb-2">Complemento:</label>
                                            <x-text-input name="complement" id="complement" placeholder="Complemento" value="{{ $address->complement }}"></x-text-input>
                                        </div>
                                        <div class="flex justify-center">
                                            <x-primary-button class="mr-2 bg-blue-500 text-lg">Editar</x-primary-button>
                                            <x-primary-button @click="showEdit = false">Cancelar</x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </template>


                    </div>
                    @endforeach

                    @else
                    <h2 class="text-lg font-bold bg-text-black text-center"> Você ainda não tem nenhum endereço cadastrado! </h2>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

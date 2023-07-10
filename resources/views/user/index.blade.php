<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

            Olá, {{ Auth::user()->name }}! <br>

        </h2>
        <p> Você está logado com {{ Auth::user()->email }}. <br>
            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-4 text-left ml-5">
                        <img src="{{ asset('logo.png') }}" alt="imagem do logotipo" style="width: 100px; margin-right: 0px;">
                        <h1 class="text-lg font-bold ">Feira Na Mão</h1>
                        <h1 class="text-3xl mt-4 font-bold text-center text-green-800 underline"> Usuários</h1>
                    </div>

                    <br>
                    @if(Auth::user() ->type=='administrador')
                    @foreach (App\Models\user::all() as $user)
                    <div class="flex justify-between border-b border-green-800 mb-2 gap-4
                    hover:bg-lime-100" x-data=" { showDelete: false, showEdit: false  } ">

                        <div class="flex justify-between flex-grow text-lg">


                            Nome: {{ $user-> name }} <br>
                            Email: {{ $user-> email }} <br>
                            Tipo usuário: {{ $user-> type }}



                            @if(Auth::user() ->email == $user-> email)
                            <p class="mt-5 mr-5 text-green-800 underline">Conta que você está logado atualmente</p>
                            @endif
                        </div>

                        <div class="flex gap-2 mt-5">
                            <div>
                                <span class="cursor-pointer border rounded-md px-2 bg-red-500 text-white" @click="showDelete = true ">Apagar</span>
                            </div>
                        </div>

                        <template x-if="showDelete">
                            <div class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20"></div>
                                <div class="w-96 bg-white p-4 relative z-10">
                                    <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                    <div class="flex justify-center">
                                        <form action="{{ route('user.destroy', $user) }}" method="POST">
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


                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

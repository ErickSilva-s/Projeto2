<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-3xl mt-4 text-green-800 font-bold text-center underline">Tire Suas Dúvidas Aqui</h1>
                    <br>
                    <p class="font-bold text-lg text-center">Confira as dúvidas mais frequetes de clientes como você, <br> ou faça uma pergunta para nossa equipe e para os vendedores!</p>
                    <br>
                    <br>

                    <h1 class="font-semibold text-2xl text-orange-600 text-center">Dúvidas Frequentes:</h1>
                    <br>

                    <div class="flex border border-green-800">

                        <div class="w-1/2  bg-lime-100 flex justify-center items-center">
                            <div class="text-xl ">
                                <p class="bg-green-800 text-white"> -Como editar minhas informações?</p>
                                <br>
                                <p class="border ml-8 mr-8 text-lg">Para editar suas informaçãoes de login, <br>
                                    va na parte superio da pagina e aperte no <br>
                                    botão laranja que contem seu nome e clique em "profile"</p>
                                <br>

                                <p class="bg-green-800 text-white">-Como fazer um pedido?</p>
                                <br>
                                <p class="border ml-8 mr-8 text-lg">Para fazer um pedido voce precisa escolher o produto desejado
                                    e clicar em "adicionar ao carrinho";Na aba acima em "meu carrinho" clique em
                                    "finalizar compra", selecione a forma de pagamento e o endereço para entrega, e prontinho! Pedido feito.
                                </p>

                                <p class="bg-green-800 text-white">-Por onde falar com o vendedor?</p>
                                <br>
                                <p class="border ml-8 mr-8 text-lg">
                                    Para entrar em contato com um vendedor voce pode mandar um email quando quer falar com
                                    um vendedor especifico ou mandar sua duvida aqui para que alguns dos vendedores do Feira na Mão
                                    possam responder você.
                                </p>
                            </div>
                        </div>
                        <!-- DIVISÃO 2 -->
                        <div class="w-1/2 p-12 bg-green-200 ">
                            <div class="text-xl ml-0 mt-0">
                                <p class="bg-green-800 text-white">4-Quais as formas de pagamento?</p>
                                <br>
                                <p class="border ml-8 mr-8 text-lg">

                                </p>
                                <p class="bg-green-800 text-white">5-Como pagar?</p>
                                <br>
                                <p class="bg-green-800 text-white">6-Como funciona a entrega?</p>
                                <br>
                            </div>

                        </div>
                    </div>

                    <br>
                    <div class="mt-4 center text-center flex items-center justify-center ">
                    <img src="{{ asset('logo.png') }}" alt="imagem do logotipo"  style="width: 100px;">
                    </div>
                    <h1 class="text-lg text-center font-bold ml-4">Feira Na Mão</h1>
                    <br>

                    @if((Auth::user()->type=='cliente'))
                <div class="bg-white border border-lime-100">
                    <h1 class="font-semibold text-2xl text-green-800 text-center">Faça uma pergunta aos vendedores ou a nossa equipe:</h1>
                     <br>
                    <div class="text-center" x-data="{ showForm: false }">
                    <x-primary-button class=" bg-orange-600" @click="showForm = !showForm">
                        Fazer uma Pergunta
                    </x-primary-button>
                    <br>
                    <br>

                    <div x-show="showForm" class="text-center">
                    <form method="POST" action="{{ route('questions.store') }}">
                        @csrf

                        <div class="mt-4 text-center">
                            <br>
                            <div>
                                <x-input-label for="question" :value="__('Fazer pergunta')" />
                                <textarea name="question" class="" style="width: 900px; height:100px;" required></textarea>
                            </div>

                            <div>
                                <x-primary-button type="submit" class="bg-orange-600">Perguntar </x-primary-button>
                            </div>

                        </div>
                    </form>
                    </div>
                    </div>
                    @endif
                </div>
                    <br>
                    <br>

                    <h1 class="font-semibold text-2xl text-black text-center">Confira as dúvidas de outros usuarios:</h1>

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @foreach ($questions as $question)
                    <div class="text-xl border  rounded mt-5 bg-white">
                        <p class="font-bold ml-2">{{ $question->user->name}}</p>
                        <p class="ml-4">{{ $question->question }}</p>

                        <br>
                        @if ($question->answer)
                        <div class="border border-lime-200 ml-9 mr-9 mb-5 rounded">
                            <!-- <h4 class="text-green-800">Respostas:</h4>
                            <br> -->
                            <p class="font-bold ml-2">{{ $question->user->name }} </p>
                            <p class="text-sm ml-2">({{ $question->user->type}}) </p> <br>
                            <p class="ml-4">{{ $question->answer }}</p>
                        </div>
                    </div>

                    @else
                    <p>Aguardando resposta...</p>
                    @endif

                    @if((Auth::user()->type=='vendedor' || (Auth::user()->type=='administrador')))
                    <form method="POST" action="{{ route('questions.answer', $question->id) }}">
                        @csrf

                        <div class="mt-4 text-center">
                            <div>
                                <x-input-label for="answer" :value="__('Reponder')" />
                                <textarea name="answer" class="" style="width: 900px; height:100px;" required></textarea>
                            </div>

                            <div>
                                <x-primary-button type="submit" class="bg-green-900">Responder </x-primary-button>
                            </div>

                        </div>
                    </form>
                    @endif
                    @endforeach



                </div>
            </div>
        </div>
    </div>

</x-app-layout>
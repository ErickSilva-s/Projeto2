<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-3xl mt-4 text-green-800 font-bold text-center underline">Tire Suas Dúvidas Aqui</h1>
                    <br>
                    @if(Auth::user()->type == 'cliente')
                    <p class="font-bold text-lg text-center">Confira as dúvidas mais frequentes de clientes como você, <br> ou faça uma pergunta para nossa equipe e para os vendedores!</p>
                    @else
                    <p class="font-bold text-lg text-center">Confira as duvidas de seus clientes e ajude-os a melhoras suas experiência no Feira na Mão. <br>
                        Voce pode responde-los!</p>
                    @endif
                    <br>
                    <br>

                    <h1 class="font-semibold text-2xl text-orange-600 text-center">Dúvidas Frequentes:</h1>
                    <br>

                    <div class="flex border border-green-800">
                        <div class="w-1/2  border border-green-800 bg-lime-100 flex justify-center items-center">
                            <div class="text-xl">
                                <p class="bg-green-800 text-white"> -Como editar minhas informações?</p>
                                <br>
<<<<<<< HEAD
                                <p class="border ml-8 mr-8 text-lg">Para editar suas informações de login, <br>
=======
                                <p class="border ml-8 mr-8 text-lg ">Para editar suas informações de login, <br>
>>>>>>> test
                                    va na parte superior da pagina e aperte no <br>
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
                                <br>
                                <br>
                            </div>
                        </div>
                        <!-- DIVISÃO 2 -->
                        <div class="w-1/2  bg-lime-100  border border-green-800 ">
                            <div class="text-xl ">
                                <p class="bg-green-800 text-white">-Quais as formas de pagamento?</p>
                                <br>

                                <p class="border ml-8 mr-8 text-lg">
                                    Aqui no Feira na Mão voce pode pagar por transferência bancaria ou pix, direto para a conta do vendedor.

                                </p>
                                <br>
                                <br>
                                <p class="bg-green-800 text-white">-Como pagar?</p>
                                <br>
                                <p class="border ml-8 mr-8 text-lg">
                                    Após finalizar a compra, os vendedores correspondentes aos produtos que você comprou
                                    irão lhe enviar suas determinadas informações de pagamento (de acordo com a opção que voce selecionou:pix ou transferência bancaria)

                                </p>
                                <br>
                                <p class="bg-green-800 text-white">-Como funciona a entrega?</p>
                                <br>
                                <p class="border ml-8 mr-8 text-lg">
                                    Após voce finalizar sua compra algum dos nossos enregadores disponíveis irão aceitar fazer a entrega, que são
                                    profissionais que ja trabalham, moram e portanto conhecem muito bem o município; ele entrará em contato com voce para informar o custo da corrida, e voces manterão comunicação.
                                </p>
                                <br>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="mt-4 center text-center flex items-center justify-center ">
                        <img src="{{ asset('logo.png') }}" alt="imagem do logotipo" style="width: 100px;">
                    </div>
                    <h1 class="text-lg text-center font-bold ml-4">Feira Na Mão</h1>
                    <br>

                    @if(Auth::user()->type == 'cliente')
                    <div class="bg-white border border-orange-600">
                        <br>
                        <h1 class="font-semibold text-2xl text-green-800 text-center">Faça uma pergunta aos vendedores ou à nossa equipe:</h1>
                        <br>
                        <div class="text-center" x-data="{ showForm: false }">
                            <x-primary-button class="bg-orange-600" @click="showForm = !showForm">
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
                                            <x-primary-button type="submit" class="bg-orange-600">Perguntar</x-primary-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    @endif

                    <h1 class="font-semibold text-2xl text-black text-center">Confira as dúvidas de outros usuários:</h1>

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @foreach ($questions as $question)
                    <div class="text-xl rounded mt-5 ">
                        <div class="border border-green-800 rounded bg-lime-100">
                        <p class="font-bold ml-2 mt-2">{{ $question->user->name}}</p>
                        <p><span class="ml-2 text-sm text-gray-500">{{ $question->created_at->diffForHumans() }}</span></p>

                        <p class="ml-4 mt-3">{{ $question->question }}</p>
                        </div>
                        <br>

                        @if ($question->answers->count() > 0)
                        @php
                        $answers = $question->answers->take(2); // Pegar apenas as duas primeiras respostas
                        $remainingAnswers = $question->answers->slice(2); // Pegar as respostas restantes
                        @endphp

                        @foreach ($answers as $answer)
                        <div class="border bg-white border-lime-200 ml-9 mr-9 mb-5 rounded">
                            <p class="font-bold ml-2">{{ $answer->user->name }} ({{ $answer->user->type }})</p>
                            <p><span class="ml-2 text-sm text-gray-500">{{ $answer->created_at->diffForHumans() }}</span></p>
                            <br>
                            <p class="ml-4">{{ $answer->answer }}</p>
                        </div>
                        @endforeach

                        @if (count($remainingAnswers) > 0)
                        <div class="" x-data="{ showMore: false }">
                            <div class="text-sm text-right mr-8">
                                <a class="underline" @click="showMore = !showMore">
                                    Ver outras respostas
                                </a>
                            </div>
                            <br>
                            <div x-show="showMore" class="text-center">
                                @foreach ($remainingAnswers as $answer)
                                <div class="border border-lime-200 ml-9 mr-9 mb-5 rounded">
                                    <p class="font-bold ml-2">{{ $answer->user->name }} ({{ $answer->user->type }})</p>
                                    <p><span class="ml-2 text-sm text-gray-500">{{ $answer->created_at->diffForHumans() }}</span></p>
                                    <br>
                                    <p class="ml-4">{{ $answer->answer }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @else
                        <p class="text-sm ml-8">Aguardando resposta...</p>
                        @endif



                        @if(Auth::user()->type == 'vendedor' || Auth::user()->type == 'administrador' )

                            <br>
                            <div class="text-center" x-data="{ showForm: false }">
                                <x-primary-button class="bg-orange-600" @click="showForm = !showForm">
                                    Responder
                                </x-primary-button>
                                <br>
                                <br>
                                <div x-show="showForm" class="text-center">
                                    <form action="{{ route('answers.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        <textarea name="answer" style="width: 900px; height:100px;" required placeholder="Digite sua resposta"></textarea>
                                        <br>
                                        <x-primary-button type="submit" class="bg-orange-600">Enviar</x-primary-button>
                                    </form>
                                </div>
                            </div>

                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
    </div>

=======
>>>>>>> test
</x-app-layout>

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl mt-4 text-green-800 font-bold text-center underline">Tire Suas Dúvidas Aqui</h1>
                    <br>
                    <p class=" font-bold text-center">Confira as dúvidas mais frequetes de clientes como você, <br> ou faça uma pergunta para nossa equipe e para os vendedores!</p>

                    <br>

                    <h1 class="font-bold text-xl text-orange-600">Dúvidas Frequentes:</h1>

                    <p>jhgjhghjgjghjgv FAZER AS DUVIDAS gagjhgggkki</p>
                    <br>

                    <h1 class="font-bold text-xl text-orange-600">Confira as dúvidas de outros usuarios:</h1>

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
                    @endforeach



                    @if((Auth::user()->type=='cliente'))

                    <form method="POST" action="{{ route('questions.store') }}">
                        @csrf

                        <div class="mt-4 text-center">
                            <div>
                                <x-input-label for="question" :value="__('Fazer pergunta')" />
                                <textarea name="question" class="" style="width: 900px; height:100px;" required></textarea>
                            </div>

                            <div>
                                <x-primary-button type="submit" class="bg-green-900">Perguntar </x-primary-button>
                            </div>

                        </div>
                    </form>
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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
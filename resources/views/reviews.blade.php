@if(Auth::user()->type == 'administrador')
<x-app-layout>

<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    Olá, {{ Auth::user()->name }}, gerencie as avaliações dos clientes <br>
</h2>
<p> Você está logado com {{ Auth::user()->email }}. <br>
    {{ \Carbon\Carbon::now()->format('d/m/Y') }}
</p>

</x-slot>

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

            <h1 class="text-3xl text-center font-semibold text-orange-600 font-sans"> Avaliações pendentes </h1>

            @php
            $reviews = App\Models\Review::all();
            $pendingReviews = $reviews->where('checked', false);
            @endphp

            @if ($pendingReviews->count() > 0)
            @foreach ($pendingReviews as $review)
            <div class="mt-4" x-data="{ showDelete: false }">
                <p class="font-semibold" style="font-size:20px;">{{ $review->title}}</p>
                <p>Classificação: {{ $review->rating }} Estrela(s)</p>
                <p>Comentário: {{ $review->comment }}</p>
                <p>Avaliado por: {{ $review->user->name }}</p>

                <div class="flex gap-2">
                    <div>
                        <form action="{{ route('markReviewChecked', $review->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="border rounded-md px-2 bg-green-500 text-white">Marcar como verificada</button>
                        </form>
                    </div>

                    <div class="flex gap-2">
                        <div>
                            <span class="cursor-pointer border rounded-md px-2 bg-red-500 text-white" @click="showDelete = true">Apagar</span>
                        </div>
                        <hr>

                        <template x-if="showDelete">
                            <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10">
                                    <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                    <form action="{{ route('review.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <x-danger-button class="bg-red-300 hover:bg-red-500">Apagar</x-danger-button>
                                    </form>
                                    <x-primary-button class="w-full" @click="showDelete = false">Cancelar</x-primary-button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="mt-4 text-center">
                <p>Nenhuma avaliação pendente, por enquanto</p>
            </div>
            @endif
        </div>
    </div>
</div>
</div>


</x-app-layout>
@endif

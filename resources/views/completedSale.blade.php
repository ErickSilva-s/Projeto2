<div>

    <h1 class="text-xl font-bold ml-4">Feira Na Mão</h1>

    <h2 class="text-2xl mt-4 text-black font-bold text-center">Resumo da Venda </h2><br>

    <!-- PRA USAR O CHECKOUT -->

    @foreach (App\Models\Checkout::all() as $index => $checkout)
    @foreach(Auth::user()->myCheckouts as $checkouts)

    @endforeach
    @endforeach

    <h3>Cliente</h3>
    <div>
        <p>Nome: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>

    </div>

    <h3>Endereço de Entrega</h3>
    <div>
        <p>CEP:{{$checkouts-> address->cep }}, {{$checkouts-> address->road}}, {{ $checkouts->address->number }},
            {{ $checkouts->address->neighborhood}}, Complemento: {{$checkouts-> address->complement}}
        </p>
    </div>
    <br>
    <h3>Pagamento</h3>
    <div>
        <p>Forma de Pagamento: {{ $checkouts->paymentMethod }}</p>
        <p>
    </div><br>

    <h3>Detalhe dos produtos</h3>

    @foreach (Auth::user()->myCarts as $cartItem)
    @foreach (App\Models\Product::all() as $product)
    @if($cartItem->product_id == $product->id)

    <div class="border ml-3">
        <b> <p>Descrição: {{ $product->description }}</p></b>
        <p>Categoria: {{ $product->category }}</p>
        <p>Valor: R$ {{ $product->price }}</p>
        <p>Quantidade: {{ $cartItem->quantity }}</p>
        <p>Valor total do produto: R${{ $cartItem-> quantity * $product->price }}
        <p>
        <p class="text-sm">**Valor calculado com o preço da unidade multiplicado pela quantidade</p>

    </div><br>

    @endif
    @endforeach
    @endforeach


    <p style="margin-left: 0px;">Parabéns pela venda!
    <p>
    <p>att, equipe do Feira na Mão</p>
    <p class="text-right"> Abreu e Lima,{{ \Carbon\Carbon::now()->format('d/m/Y') }} </p>


</div>
</div>

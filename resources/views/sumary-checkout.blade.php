
<div>

                                <h1 class="text-xl font-bold ml-4">Feira Na Mão</h1>

    <h2 class="text-2xl mt-4 text-black font-bold text-center">Resumo do Pedido </h2><br>

    <!-- NÃO APAGAR ISSO -->
    @php
    $totalCarrinho = 0;
    @endphp

    <!-- PEGAR O VALOR TOTAL -->

    @foreach (Auth::user()->myCarts as $cartItem)
    @foreach (App\Models\Product::all() as $product)
    @if($cartItem->product_id == $product->id)

    @php
    $totalCarrinho += $cartItem->quantity * $product->price;
    @endphp

    @endif
    @endforeach
    @endforeach

    <!-- PRA USAR O CHECKOUT -->

    @foreach (App\Models\Checkout::all() as $index => $checkout)
    @foreach(Auth::user()->myCheckouts as $checkouts)

    @endforeach
    @endforeach

    <h3>Cliente</h3>
    <div class="border ml-3">
        <p>Nome: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>

    </div><br>

    <h3>Endereço de Entrega</h3>
    <div class="border ml-3">
        <p>CEP:{{$checkouts-> address->cep }}, {{$checkouts-> address->road}}, {{ $checkouts->address->number }},
            {{ $checkouts->address->neighborhood}}, Complemento: {{$checkouts-> address->complement}}
        </p>
    </div>
    <br>
    <h3>Pagamento</h3>
    <div class="border ml-3">
        <p>Forma de Pagamento: {{ $checkouts->paymentMethod }}</p>
        <p>Total a ser pago: R$ {{ $totalCarrinho }}
        <p>
    </div><br>

    <h3>Detalhe dos produtos</h3>

    @foreach (Auth::user()->myCarts as $cartItem)
    @foreach (App\Models\Product::all() as $product)
    @if($cartItem->product_id == $product->id)

    <div class="border ml-3">
        <p>Descrição: {{ $product->description }}</p>
        <p>Categoria: {{ $product->category }}</p>
        <p>Vendedor: {{ $product->User->name }}</p>
        <p>Email do vendedor: {{ $product->User->email }}</p>
        <p>Valor: R$ {{ $product->price }}</p>
        <p>Quantidade: {{ $cartItem->quantity }}</p>
        <p>Valor total do produto: R${{ $cartItem-> quantity * $product->price }}
        <p>
        <p class="text-sm">**Valor calculado com o preço da unidade multiplicado pela quantidade</p>

    </div><br>

    @endif
    @endforeach
    @endforeach


    <p  style="margin-left: 0px;">Obrigada por comprar conosco!<p>
    <p>att, equipe do Feira na Mão</p>
    <p class="text-right"> Abreu e Lima,{{ \Carbon\Carbon::now()->format('d/m/Y') }} </p>


</div>
</div>

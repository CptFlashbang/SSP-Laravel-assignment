<x-app-layout>
    <div class="container">
        <h1>Your Order</h1>

        @if ($pizzas->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="list-group">
                @foreach ($pizzas as $item)
                    <div class="list-group-item">
                        <strong>{{ $item['size'] }} {{ $item['name'] }}</strong>
                        <p>Quantity: {{ $item['quantity'] }}</p>
                        <p>Price per item: £{{ number_format($item['price'], 2) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
        <form action="{{ route('session.clear') }}" method="POST">
            @csrf
            <button type="submit">Clear All Session Data</button>
        </form>
    </div>
</x-app-layout>



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
            <!-- Save Order Form -->
            <form action="{{ route('order.save') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Save Order</button>
            </form>
        @endif
        <!-- Clear Order Form -->
        <form action="{{ route('session.clear') }}" method="POST">
            @csrf
            <button type="submit">Clear order data</button>
        </form>
    </div>
</x-app-layout>

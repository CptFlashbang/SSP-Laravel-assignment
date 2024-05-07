<x-app-layout>
    <div class="container">
        <h1>Your Order</h1>
        @php
            dd(session('order'));
        @endphp
        @if ($pizzas->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="list-group">
                @php $totalCost = 0; @endphp  <!-- Initialize the total cost variable -->
                @foreach ($pizzas as $item)
                    <div class="list-group-item">
                        <strong>{{ $item['size'] }} {{ $item['name'] }}</strong>
                        <p>Quantity: {{ $item['quantity'] }}</p>
                        <p>Price per item: £{{ number_format($item['price'], 2) }}</p>
                        @php $totalCost += $item['price'] * $item['quantity']; @endphp <!-- Update total cost -->
                    </div>
                @endforeach
                <div class="list-group-item">
                    <strong>Total Cost: £{{ number_format($totalCost, 2) }}</strong> <!-- Display the total cost -->
                </div>
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

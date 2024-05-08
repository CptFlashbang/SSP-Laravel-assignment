<x-app-layout>
    <div class="container">
        <h1>Your previous orders</h1>
        @if($orders->isEmpty())
            <p>You have no previous orders.</p>
        @else
            @foreach ($orders as $order)
                <div class="order-summary">
                    <h2>Order placed on: {{ $order->created_at->format('M d, Y') }}</h2>
                    <ul>
                        @foreach ($order->orderItems as $item) <!-- Loop through order items -->
                            @if($item->pizza) <!-- Check if the order item has a pizza -->
                                <li>{{ $item->pizza->size }} - {{ $item->pizza->name }}</li>
                            @endif
                        @endforeach
                    </ul>
                    <p>Total Price: ${{ number_format($order->totalPrice, 2) }}</p>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>

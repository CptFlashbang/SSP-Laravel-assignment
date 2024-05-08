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
                @foreach ($pizzas as $item)
                    <div class="list-group-item">
                        <strong>{{ $item['size'] }} {{ $item['name'] }}</strong>
                        <p>Quantity: {{ $item['quantity'] }}</p>
                        <p>Price per item: £{{ number_format($item['price'], 2) }}</p>
                    </div>
                @endforeach
                <div class="list-group-item">
                    <strong>Total Cost: £{{ number_format($totalPrice, 2) }}</strong> <!-- Display the calculated total cost -->
                </div>
                @if ($isDelivery)
                    <p>Includes delivery charge of £5.00</p>
                @endif
            </div>
            <!-- Update Delivery Option Form -->
            <form action="{{ route('order.update-delivery') }}" method="POST">
                @csrf
                <div>
                    <label>
                        <input type="radio" name="delivery_type" value="collection" {{ !$isDelivery ? 'checked' : '' }}> Collection
                    </label>
                    <label>
                        <input type="radio" name="delivery_type" value="delivery" {{ $isDelivery ? 'checked' : '' }}> Delivery
                    </label>
                    <button type="submit" class="btn btn-primary">Update Delivery Option</button>
                </div>
            </form>
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

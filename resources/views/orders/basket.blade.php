<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Your Order</h1>

        @if ($pizzas->isEmpty())
            <p class="text-gray-600">Your cart is empty.</p>
        @else
            <div class="space-y-2">
                @foreach ($pizzas as $item)
                    <div class="p-4 bg-gray-100 rounded-md">
                        <strong class="text-lg text-gray-700">{{ $item['size'] }} {{ $item['name'] }}</strong>
                        <p class="text-gray-600">Price per item: £{{ number_format($item['price'], 2) }}</p>
                    </div>
                @endforeach
                <div class="p-4 bg-gray-100 rounded-md">
                    <strong class="text-lg text-gray-700">Total Cost: £{{ number_format($totalPrice, 2) }}</strong>
                </div>
                @if ($isDelivery)
                    <p class="text-gray-600">Includes delivery charge of £5.00</p>
                @endif
            </div>

            <form action="{{ route('order.update-delivery') }}" method="POST" class="mt-4">
                @csrf
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="delivery_type" value="collection" class="text-indigo-600 focus:ring-indigo-500" {{ !$isDelivery ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Collection</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="delivery_type" value="delivery" class="text-indigo-600 focus:ring-indigo-500" {{ $isDelivery ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Delivery</span>
                    </label>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Delivery Option</button>
                </div>
            </form>

            <form action="{{ route('order.save') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Save Order</button>
            </form>

            <form action="{{ route('session.clear') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Clear Order Data</button>
            </form>
        @endif
    </div>
</x-app-layout>

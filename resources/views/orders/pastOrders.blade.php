<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Your Previous Orders</h1>

        @if($orders->isEmpty())
            <p class="text-gray-600">You have no previous orders.</p>
        @else
            <div class="space-y-6">
                @foreach ($orders as $order)
                    <div class="p-4 bg-gray-100 rounded-md">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Order placed on: {{ $order->created_at->format('M d, Y') }}</h2>
                        <ul class="list-disc pl-5 text-gray-600">
                            @foreach ($order->orderItems as $item)
                                    <li>{{ $item->size }} - {{ $item->pizza->name }}</li>
                            @endforeach
                        </ul>
                        <p class="text-gray-700">Total Price: £{{ number_format($order->totalPrice, 2) }}</p>
                        <form action="{{ route('orders.reorderToSession', $order->id) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Reorder This Order</button>
                        </form>
                    </div>                
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>

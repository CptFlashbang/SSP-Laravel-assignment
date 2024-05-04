<div class="mt-16">
    <h1 class="text-2xl font-bold text-center mb-6">Toppings</h1>
    <div class="bg-white shadow-sm rounded-lg p-6">
        <ul class="divide-y divide-gray-200">
            @foreach ($toppings as $topping)
                <li class="py-2 text-gray-700 text-base">{{ $topping->name }}</li>
            @endforeach
        </ul>
    </div>
</div>

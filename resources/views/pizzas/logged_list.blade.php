<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($pizzas as $pizza)
        <div class="max-w-sm rounded overflow-hidden shadow-lg p-4 m-4">
            <img class="w-full" src="{{ $pizza->imagePath }}" alt="Pizza Image">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $pizza->name }}</div>
                <ul class="text-gray-700 text-base mb-4">
                    @foreach ($pizza->toppings as $topping)
                        <li>{{ $topping->name }}</li>
                    @endforeach
                </ul>
                <div>
                <select id="size_{{ $pizza->id }}" name="size" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" onchange="updatePrice({{ $pizza->id }})">
                    <option value="small" data-price="{{ $pizza->SmallPrice }}">Small - £{{ number_format($pizza->SmallPrice, 2) }}</option>
                    <option value="medium" data-price="{{ $pizza->MediumPrice }}">Medium - £{{ number_format($pizza->MediumPrice, 2) }}</option>
                    <option value="large" data-price="{{ $pizza->LargePrice }}">Large - £{{ number_format($pizza->LargePrice, 2) }}</option>
                </select>

                </div>
                <div class="mt-4">
                    Price: <span id="price_{{ $pizza->id }}">£{{ number_format($pizza->SmallPrice, 2) }}</span>
                </div>
                <form action="{{ route('add-pizza-to-session', ['pizzaId' => $pizza->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="price" id="price_input_{{ $pizza->id }}" value="{{ $pizza->SmallPrice }}">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add to Order
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>


<script>
    function updatePrice(pizzaId) {
        var select = document.getElementById('size_' + pizzaId);
        var price = select.options[select.selectedIndex].getAttribute('data-price');
        document.getElementById('price_' + pizzaId).textContent = '£' + parseFloat(price).toFixed(2);
        document.getElementById('price_input_' + pizzaId).value = price;
    }
</script>

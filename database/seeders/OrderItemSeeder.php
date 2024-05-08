<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all orders and pizzas with their details
        $orderIds = DB::table('orders')->pluck('id');
        $pizzas = DB::table('pizzas')->get();  // Including price details
        $sizes = ['small', 'medium', 'large'];  // Available sizes

        foreach ($orderIds as $orderId) {
            $totalPrice = 0;  // Initialize total price for each order right at the start of the loop

            // Randomly select 1-3 pizzas per order
            $selectedPizzas = $pizzas->random(rand(1, 3));

            foreach ($selectedPizzas as $pizza) {
                $size = $sizes[array_rand($sizes)];  // Randomly assign a size
                $priceAttribute = ucfirst($size) . 'Price';  // Construct the attribute name for price based on size
                $price = $pizza->$priceAttribute;  // Get the price from the pizza object dynamically

                $quantity = rand(1, 4);  // Random quantity between 1 and 4
                $totalPrice += $price * $quantity;  // Accumulate the total price

                // Insert a new order item for each selected pizza
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'pizza_id' => $pizza->id,
                    'size' => $size,
                    'price' => $price,  // Use dynamically determined price based on size
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Update the order with the calculated total price
            DB::table('orders')->where('id', $orderId)->update(['totalPrice' => $totalPrice]);
        }
    }
}


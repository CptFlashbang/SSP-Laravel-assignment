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
        // Let's assume we have some orders and pizzas
        $orderIds = DB::table('orders')->pluck('id');
        $pizzaIds = DB::table('pizzas')->pluck('id');

        // Example logic to assign pizzas to orders
        foreach ($orderIds as $orderId) {
            // Randomly select 1-3 pizzas per order
            $selectedPizzas = $pizzaIds->random(rand(1, 3));

            foreach ($selectedPizzas as $pizzaId) {
                // Insert a new order item for each selected pizza
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'pizza_id' => $pizzaId,
                    'quantity' => rand(1, 4),  // Random quantity between 1 and 4
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

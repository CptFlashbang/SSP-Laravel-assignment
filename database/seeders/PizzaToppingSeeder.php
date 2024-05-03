<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define pizza to toppings mappings
        $pizzas = [
            'Margherita' => ['Cheese', 'Tomato sauce'],
            'Gimme the Meat' => ['Pepperoni', 'Ham', 'Chicken', 'Minced beef', 'Sausage', 'Bacon'],
            'Veggie Delight' => ['Onions', 'Green peppers', 'Mushrooms', 'Sweetcorn'],
            'Make Mine Hot' => ['Chicken', 'Onions', 'Green peppers', 'Jalapeno peppers']
        ];

        // Populate the pizza_topping table
        foreach ($pizzas as $pizzaName => $toppings) {
            $pizzaId = DB::table('pizzas')->where('name', $pizzaName)->value('id');

            foreach ($toppings as $toppingName) {
                $toppingId = DB::table('toppings')->where('name', $toppingName)->value('id');

                DB::table('pizza_topping')->insert([
                    'pizza_id' => $pizzaId,
                    'topping_id' => $toppingId
                ]);
            }
        }
    }
}

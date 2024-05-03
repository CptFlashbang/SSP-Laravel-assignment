<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toppings = [
            'Bacon',
            'Cheese',
            'Chicken',
            'Green peppers',
            'Ham',
            'Hot dog pieces',
            'Jalapeno peppers',
            'Minced beef',
            'Mushrooms',
            'Olives',
            'Onions',
            'Pepperoni',
            'Pineapple',
            'Salami',
            'Sausage',
            'Spicy beef',
            'Sweetcorn',
            'Tomato sauce',
            'Vegan cheese'
        ];

        foreach ($toppings as $topping) {
            DB::table('toppings')->insert([
                'name' => $topping,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


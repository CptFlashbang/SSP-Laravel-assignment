<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pizzas = [
            [
                'name' => 'Margherita',
                'imagePath' => 'path/to/image/margherita.jpg',
                'SmallPrice' => '8',
                'MediumPrice' => '9',
                'LargePrice' => '12'
            ],
            [
                'name' => 'Gimme the Meat',
                'imagePath' => 'path/to/image/gimme-the-meat.jpg',
                'SmallPrice' => '11',
                'MediumPrice' => '14.50',
                'LargePrice' => '16.50'
            ],
            [
                'name' => 'Veggie Delight',
                'imagePath' => 'path/to/image/veggie-delight.jpg',
                'SmallPrice' => '10',
                'MediumPrice' => '13',
                'LargePrice' => '15'
            ],
            [
                'name' => 'Make Mine Hot',
                'imagePath' => 'path/to/image/make-mine-hot.jpg',
                'SmallPrice' => '11',
                'MediumPrice' => '13',
                'LargePrice' => '15'
            ]
        ];

        foreach ($pizzas as $pizza) {
            DB::table('pizzas')->insert([
                'name' => $pizza['name'],
                'imagePath' => $pizza['imagePath'],
                'SmallPrice' => $pizza['SmallPrice'],
                'MediumPrice' => $pizza['MediumPrice'],
                'LargePrice' => $pizza['LargePrice'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}


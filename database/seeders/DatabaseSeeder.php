<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PizzaSeeder::class,
            ToppingSeeder::class,
            PizzaToppingSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
        ]);
    }
}

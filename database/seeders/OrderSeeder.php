<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, fetch all user ids
        $userIds = DB::table('users')->pluck('id');

        // Iterate over each user ID and create random orders
        foreach ($userIds as $userId) {
            // Each user can have between 1 to 5 orders
            for ($i = 0; $i < rand(1, 5); $i++) {
                DB::table('orders')->insert([
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

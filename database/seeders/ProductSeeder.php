<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'name' => 'Main Branch',
                'location' => 'Jakarta, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'West Branch',
                'location' => 'Bandung, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'East Branch',
                'location' => 'Surabaya, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'North Branch',
                'location' => 'Medan, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'South Branch',
                'location' => 'Bali, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

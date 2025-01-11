<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run()
    {
        Store::create([
            'name' => 'Store A',
            'location' => 'Location A',
            'image-url' => 'https://via.placeholder.com/100',
        ]);

        Store::create([
            'name' => 'Store B',
            'location' => 'Location B',
            'image-url' => 'https://via.placeholder.com/100',
        ]);
    }
}

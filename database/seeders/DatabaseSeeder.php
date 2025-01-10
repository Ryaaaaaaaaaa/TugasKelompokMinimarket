<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'owner']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'cashier']);
        Role::create(['name' => 'stocker']);
        Role::create(['name' => 'admin']);

        $branch = Branch::create([
            'name' => 'Cabang Pusat',
            'location' => 'Cianjur'
        ]);
        $owner = User::create([
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('owner');

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $users = [];

        foreach ([
            ['name' => 'Manager User', 'email' => 'manager@example.com', 'role' => 'manager'],
            ['name' => 'Supervisor User', 'email' => 'supervisor@example.com', 'role' => 'supervisor'],
            ['name' => 'Cashier User', 'email' => 'cashier@example.com', 'role' => 'cashier'],
            ['name' => 'Stocker User', 'email' => 'stocker@example.com', 'role' => 'stocker'],
        ] as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt('password'),
                'branch_id' => $branch->id
            ]);
            $user->assignRole($userData['role']);
            $users[] = $user;
        }
    }
}

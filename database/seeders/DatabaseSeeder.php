<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'is_admin'=> 1,
            'avatar'=> "https://api.dicebear.com/7.x/initials/svg?seed=Admin&radius=50"
        ]);

        User::factory(10)->create([
            'avatar'=> "https://api.dicebear.com/7.x/initials/svg?seed=Client&radius=50"
        ]);

    }
}

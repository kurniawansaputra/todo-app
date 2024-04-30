<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Kurniawan Saputra',
            'email' => 'kurniawan@mail.test',
            'password' => bcrypt('12341234'),
        ]);

        User::create([
            'name' => 'Anisa Dika Larasati',
            'email' => 'dika@mail.test',
            'password' => bcrypt('12341234'),
        ]);

        Todo::create([
            'user_id' => 1,
            'name' => 'eu',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ]);

        Todo::create([
            'user_id' => 1,
            'name' => 'nisi',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ]);

        Todo::create([
            'user_id' => 2,
            'name' => 'bibendum',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ]);
    }
}

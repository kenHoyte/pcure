<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@pbl.com',
            'password' => Hash::make('admin123'),
            'role' => 'operator'
        ]);

        User::factory()->create([
            'name' => 'Ransford Boakye',
            'email' => 'rans@pbl.com',
            'password' => Hash::make('12345678'),
            'role' => 'manager'
        ]);
        User::factory()->create([
            'name' => 'Ken Amo',
            'email' => 'ken@pbl.com',
            'password' => Hash::make('12345678'),
            'role' => 'officer'
        ]);
    }
}

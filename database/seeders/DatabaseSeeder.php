<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
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
        $this->call([
            RoleSeeder::class,
        ]);

        $user = User::create([
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'xagent891@gmail.com',
            'password' => Hash::make('iqrash1122'),
        ]);

        $user->assignRole('admin');

        Category::factory()->count(10)->create();
        City::factory()->count(10)->create();
    }
}

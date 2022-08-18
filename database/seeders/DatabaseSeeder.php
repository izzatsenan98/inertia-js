<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => Hash::make('abcd1234'),
            'email_verified_at' => now(),
        ]);

        Category::create([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Default',
            'description' => 'Default Category',
        ]);

        Product::factory(10)->create();
    }
}

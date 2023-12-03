<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'id' => '2',
            'name' => 'Admin',
            'email' => 'admin@pnp.com',
            'password' => ('admin'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'id' => '1',
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'password' => ('guest'),
            'role'=>'user',
        ]);
    }
}

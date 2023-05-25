<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super admin',
            'username' => 'username',
            'email' => 'admin@example.com',
            'type' => 'admin',
            'email_verified_at' => now(),
            'status' => true,
        ]);
    }
}

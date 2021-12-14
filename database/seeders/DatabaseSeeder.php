<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        DB::table('admins')->insert([
            'name' => 'users',
            'surname' => 'test',
            'email' => 'users@users.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'users',
            'surname' => 'test',
            'email' => 'users@users.com',
            'phone_number' => '12445234',
            'password' => Hash::make('12345678'),
            'auth_token' => '$2y$10$S.TN4i09fMOJWU5aLuqg8uu32GMeYh1FRYn4RN8EcZlTJ31YQALCO',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('api_tokens')->insert([
            'api_token' => '$2y$10$S.TN4i09fMOJWU5aLuqg8uu32GMeYh1FRYn4RN8EcZlTJ31YQALCO',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

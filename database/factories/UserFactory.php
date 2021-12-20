<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'phone_number' =>'+38066'.$this->faker->unique()->numberBetween(1000000, 9999999),
            'auth_token' => Str::random(30),
            'role_id' => $this->faker->numberBetween(1, 2),
            'access' => $this->faker->boolean(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Str::random(30), // password
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

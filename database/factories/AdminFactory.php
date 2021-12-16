<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
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
            'surname' => $this->faker->surname(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->sentence(20), // password
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function unverified()
    // {
        // return $this->state(function (array $attributes) {
        //     return [
        //         'email_verified_at' => null,
        //     ];
        // });
    // }
}

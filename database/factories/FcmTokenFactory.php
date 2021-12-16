<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FcmTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fcm_token' => $this->faker->unique()->sentence(20),
            'created_at' => date('Y-m-d H:i:s', strtotime(now())),
            'updated_at' => date('Y-m-d H:i:s', strtotime(now())),
            'user_id' => \App\Models\User::factory(),
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

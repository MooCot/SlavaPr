<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  $this->sentence(5),
            'text' =>  $this->sentence(20),
            'marked_as_read' => 0,
            'user_id' => \App\Models\User::factory(),
            'created_at' => date('Y-m-d H:i:s', strtotime(now())),
            'updated_at' => date('Y-m-d H:i:s', strtotime(now())),
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

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_name' => $this->sentence(10),
            'task_description' => $this->sentence(20),
            'priority' => $this->randomPriority(),
            'accepted' => $this->faker->boolean(),
            'deadline_expired' => $this->faker->boolean(),
            'start_task' => date('Y-m-d H:i:s', strtotime(now())),
            'must_end_task' => date('Y-m-d H:i:s', strtotime(now())),
            'creator_id' => \App\Models\User::factory(),
        ];
    }
    public function randomPriority() {
        $data = ['high', 'normal'];
        return $data[$this->faker->boolean()];
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

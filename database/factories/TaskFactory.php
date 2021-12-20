<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'task_name' => $this->faker->paragraph(10),
            'task_description' => $this->faker->paragraph(20),
            'priority' => $this->randomPriority(),
            'accepted' => $this->faker->boolean(),
            'deadline_expired' => $this->faker->boolean(),
            'start_task' => date('Y-m-d H:i:s', strtotime(now())),
            'must_end_task' => date('Y-m-d H:i:s', strtotime(now())),
            'creator_id' => \App\Models\User::factory(),
        ];
    }
    private function randomPriority() {
        $data = ['high', 'normal'];
        return $data[$this->faker->boolean()];
    }
}

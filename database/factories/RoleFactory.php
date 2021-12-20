<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_name' => $this->randomRole(),
        ];
    }

    private function randomRole() {
        $data = ['Руководитель отдела', 'Инженер'];
        return $data[$this->faker->boolean()];
    }

}

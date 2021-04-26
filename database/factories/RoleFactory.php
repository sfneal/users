<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'type' => 'user',
            'name' => $this->faker->randomElement(['Employee', 'Administrator', 'Team Leader']),
            'description' => $this->faker->text(255),
            'order' => $this->faker->randomNumber(2),
        ];
    }
}

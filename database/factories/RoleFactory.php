<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sfneal\Users\Models\Role;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['user', 'client']),
            'name' => $this->faker->randomElement(['Employee', 'Administrator', 'Team Leader']),
            'description' => $this->faker->text(255),
            'order' => $this->faker->randomNumber(2),
        ];
    }
}

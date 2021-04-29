<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sfneal\Users\Models\Role;

class RoleFactory extends Factory
{
    public const TYPES = ['user', 'client'];
    // todo: lowercase they and add mutator
    public const NAMES = ['Employee', 'Team Leader', 'Administrator', 'Web Developer'];

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
            'type' => $this->faker->randomElement(self::TYPES),
            'name' => $this->faker->randomElement(self::NAMES),
            'description' => $this->faker->text(255),
            'order' => $this->faker->randomNumber(2),
        ];
    }
}

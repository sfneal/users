<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sfneal\Users\Models\Team;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(3),
            'order' => $this->faker->randomNumber(2),
        ];
    }
}

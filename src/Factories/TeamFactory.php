<?php

namespace Sfneal\Users\Factories;

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
            'order' => $this->faker->randomNumber(2),
        ];
    }
}

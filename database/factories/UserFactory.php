<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sfneal\Users\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->randomElement([$this->faker->randomLetter, null]),
            'last_name' => $this->faker->lastName,
            'nickname' => $this->faker->randomElement([$this->faker->firstName]),
            'nickname_preferred' => $this->faker->numberBetween(0, 1),
            'title' => $this->faker->jobTitle,
            'suffix' => null,
            'email' => $this->faker->email,
            'rate' => $this->faker->numberBetween(20, 200),
            'phone_work' => $this->faker->phoneNumber,
            'phone_mobile' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'bio' => $this->faker->text(255),
            'username' => $this->faker->userName,
            'password' => $this->faker->password,
            'status' => $this->faker->numberBetween(0, 1),
            'remember_token' => null,
        ];
    }
}

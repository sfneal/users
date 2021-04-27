<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sfneal\Users\Models\UserNotification;

class UserNotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(3),
            'type' => $this->faker->randomElement([
                'Domain\Clients\Notifications\NewInquiryNotification',
                'Domain\Plans\Notifications\BucketChangedNotification',
            ]),
        ];
    }
}

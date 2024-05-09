<?php

namespace Sfneal\Users\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Sfneal\Users\Models\UserNotification;

class UserNotificationFactory extends Factory
{
    public const TYPES = [
        'Domain\Clients\Notifications\NewInquiryNotification',
        'Domain\Plans\Notifications\BucketChangedNotification',
    ];

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
            'type' => $this->faker->randomElement(self::TYPES),
        ];
    }
}

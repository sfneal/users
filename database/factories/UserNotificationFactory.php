<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class UserNotificationFactory extends Factory
{
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
                'Domain\Plans\Notifications\BucketChangedNotification'
            ])
        ];
    }
}

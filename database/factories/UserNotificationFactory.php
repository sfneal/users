<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Users\Models\User;
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
     * UserNotificationFactory constructor.
     *
     * @param null $count
     * @param Collection|null $states
     * @param Collection|null $has
     * @param Collection|null $for
     * @param Collection|null $afterMaking
     * @param Collection|null $afterCreating
     * @param null $connection
     */
    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);

        self::createUserFactories();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => (new RandomModelAttributeQuery(User::class, 'id'))->execute(),
            'type' => $this->faker->randomElement(self::TYPES),
        ];
    }

    /**
     * Create User model factories if none exist.
     *
     * @return void
     */
    private static function createUserFactories(): void
    {
        if (! User::query()->count()) {
            User::factory()
                ->count(10)
                ->create();
        }
    }
}

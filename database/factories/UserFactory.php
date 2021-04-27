<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Users\Models\Role;
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
     * UserFactory constructor.
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

        // Create Role models if none exist
        self::createRoleFactories();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'role_id' => (new RandomModelAttributeQuery(Role::class, 'role_id'))->execute(),
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

    /**
     * Create Role model factories if none exist.
     *
     * @return void
     */
    private static function createRoleFactories(): void
    {
        if (!Role::query()->count()) {
            Role::factory()
                ->count(10)
                ->create();
        }
    }
}

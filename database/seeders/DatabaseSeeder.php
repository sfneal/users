<?php

namespace Database\Seeders;

use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\Team;
use Sfneal\Users\Models\User;
use Sfneal\Users\Models\UserNotification;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (RoleFactory::NAMES as $roleName) {
            Role::factory()
                ->has(
                    User::factory()
                        ->count(20)
                        ->has(Team::factory(), 'team')
                        ->has(UserNotification::factory(), 'notificationSubscriptions'),
                    'users'
                )
                ->create([
                    'type' => 'user',
                    'name' => $roleName,
                ]);
        }
    }
}

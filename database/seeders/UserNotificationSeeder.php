<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sfneal\Users\Models\User;
use Sfneal\Users\Models\UserNotification;

class UserNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function (User $user) {
            UserNotification::factory()
                ->count(3)
                ->create([
                    'user_id' => $user->getKey()
                ]);
        });
    }
}

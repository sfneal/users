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
        UserNotification::factory()
            ->count(100)
            ->for(User::factory(), 'user')
            ->create();
    }
}

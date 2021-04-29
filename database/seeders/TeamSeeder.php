<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sfneal\Users\Models\Team;
use Sfneal\Users\Models\User;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()
            ->limit(User::query()->count() / 2)
            ->get()
            ->each(function (User $user) {
                Team::factory()
                    ->create([
                        'user_id' => $user->getKey(),
                    ]);
            });
    }
}

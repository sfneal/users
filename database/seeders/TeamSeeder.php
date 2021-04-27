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
        Team::factory()
            ->count(15)
            ->for(User::factory(), 'user')
            ->create();
    }
}

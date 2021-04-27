<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(50)
            ->has(Role::factory(), 'role')
            ->create();
    }
}

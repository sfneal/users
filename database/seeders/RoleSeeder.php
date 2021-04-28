<?php

namespace Database\Seeders;

use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Models\User;

class RoleSeeder extends Seeder
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
                ->has(User::factory()->count(20), 'users')
                ->create([
                    'type' => 'user',
                    'name' => $roleName,
                ]);
        }
    }
}

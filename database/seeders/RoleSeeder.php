<?php

use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;
use Sfneal\Users\Models\Role;

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
                ->create([
                    'type' => 'user',
                    'name' => $roleName,
                ]);
        }
    }
}

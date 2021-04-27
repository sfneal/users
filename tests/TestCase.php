<?php

namespace Sfneal\Users\Tests;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Users\Providers\UsersServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Register package service providers.
     *
     * @param Application $app
     * @return array|string
     */
    protected function getPackageProviders($app)
    {
        return [
            UsersServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.debug', true);
        $app['config']->set('users.org.name', 'HPA Design, inc.');
        $app['config']->set('users.org.address.street', '35 Main Street');
        $app['config']->set('users.org.address.city', 'Milford');
        $app['config']->set('users.org.address.state', 'MA');
        $app['config']->set('users.org.address.zip', '01575');
        $app['config']->set('users.org.phone', '508-384-8838');
        $app['config']->set('users.org.email', 'contact@hpadesign.com');

        // Migrate 'role' table
        include_once __DIR__.'/../database/migrations/create_role_table.php.stub';
        (new \CreateRoleTable())->up();

        // Migrate 'team' table
        include_once __DIR__.'/../database/migrations/create_team_table.php.stub';
        (new \CreateTeamTable())->up();

        // Migrate 'user' table
        include_once __DIR__.'/../database/migrations/create_user_table.php.stub';
        (new \CreateUserTable())->up();

        // Migrate 'user_notification' table
        include_once __DIR__.'/../database/migrations/create_user_notification_table.php.stub';
        (new \CreateUserNotificationTable())->up();
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }
}

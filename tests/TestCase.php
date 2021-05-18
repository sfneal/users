<?php

namespace Sfneal\Users\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Address\Providers\AddressServiceProvider;
use Sfneal\Helpers\Redis\Providers\RedisHelpersServiceProvider;
use Sfneal\Users\Providers\UsersServiceProvider;
use Sfneal\Users\Tests\Database\Seeders\DatabaseSeeder;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

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
            RedisHelpersServiceProvider::class,
            AddressServiceProvider::class,
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

        // Migrate 'address' table
        include_once __DIR__.'/../vendor/sfneal/address/database/migrations/create_address_table.php.stub';
        (new \CreateAddressTable())->up();
    }
}

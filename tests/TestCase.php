<?php

namespace Sfneal\Users\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Address\Providers\AddressServiceProvider;
use Sfneal\Helpers\Redis\Providers\RedisHelpersServiceProvider;
use Sfneal\Users\Providers\UsersServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

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

        $app['config']->set('cache.default', 'redis');
        $app['config']->set('cache.prefix', 'users');
        $app['config']->set('database.redis.client', env('REDIS_CLIENT', 'mock'));
        $app['config']->set('database.redis.default.host', env('REDIS_HOST', '127.0.0.1'));
        $app['config']->set('database.redis.default.port', env('REDIS_PORT', 6379));
        $app['config']->set('database.redis.default.options.prefix', null);
        $app['config']->set('cache.stores.redis.connection', 'default');

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

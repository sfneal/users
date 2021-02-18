<?php

namespace Sfneal\Users\Tests;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Users\Providers\UsersServiceProvider;

class TestCase extends OrchestraTestCase
{
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
        ];
    }
}

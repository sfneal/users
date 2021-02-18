<?php

namespace Sfneal\Users\Providers;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any Users services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__ . '/../../config/users.php' => config_path('users.php'),
        ], 'config');
    }

    /**
     * Register any Users services.
     *
     * @return void
     */
    public function register()
    {
        // Load config file
        $this->mergeConfigFrom(__DIR__ . '/../../config/users.php', 'users');
    }
}

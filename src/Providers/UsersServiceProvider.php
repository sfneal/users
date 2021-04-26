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
            __DIR__.'/../../config/users.php' => config_path('users.php'),
        ], 'config');

        // `Role` migration file
        if (! class_exists('CreateRoleTable')) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/create_role_table.php.stub' => database_path(
                    'migrations/'.date('Y_m_d_His', time()).'_create_role_table.php'
                ),
            ], 'migration');
        }

        // `Team` migration file
        if (! class_exists('CreateTeamTable')) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/create_team_table.php.stub' => database_path(
                    'migrations/'.date('Y_m_d_His', time()).'_create_team_table.php'
                ),
            ], 'migration');
        }

        // `User` migration file
        if (! class_exists('CreateUserTable')) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/create_user_table.php.stub' => database_path(
                    'migrations/'.date('Y_m_d_His', time()).'_create_team_table.php'
                ),
            ], 'migration');
        }

        // `UserNotification` migration file
        if (! class_exists('CreateUserNotificationTable')) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/create_user_notification_table.php.stub' => database_path(
                    'migrations/'.date('Y_m_d_His', time()).'_create_user_notification_table.php'
                ),
            ], 'migration');
        }
    }

    /**
     * Register any Users services.
     *
     * @return void
     */
    public function register()
    {
        // Load config file
        $this->mergeConfigFrom(__DIR__.'/../../config/users.php', 'users');
    }
}

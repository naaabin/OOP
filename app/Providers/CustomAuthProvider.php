<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBrokerManager;

class CustomAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         // Bind the custom password broker to the service container
        $this->app->bind('auth.password', function ($app) 
        {
            return new CustomPasswordBroker(
                $app['auth']->createUserProvider(config('auth.defaults.provider')),
                $app['db']->connection(),
                $app['hash'],
                config('auth.passwords.users.email')
            );
        });
    }
}

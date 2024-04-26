<?php

namespace App\Providers;
use App\Models\User;

use App\Models\Project;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('filtering', function ($view) {
            $users = User::all();
            $projects = Project::all();
        
            $view->with('users', $users);
            $view->with('projects', $projects);
          
        });
    }
}

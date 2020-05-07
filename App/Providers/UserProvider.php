<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
class UserProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('user', function($app, $parameters = []) {
            $user = new \App\User;

            if(!empty($parameters)) {
                $user = $user::with(['warehouses', 'userRoles'])->isNotBlock()->where($parameters)->first();
            }
            return $user; 
         });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

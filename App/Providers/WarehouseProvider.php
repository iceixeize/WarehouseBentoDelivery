<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WarehouseProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('warehouse', function($app, $parameters) {
            $warehouse = new \App\Models\Warehouse;
            if(isset($parameters['subdomain'])) {
                return $warehouse::where('subdomain', $parameters['subdomain'])->first();
            }
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

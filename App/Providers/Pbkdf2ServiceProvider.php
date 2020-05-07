<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class Pbkdf2ServiceProvider extends \Illuminate\Hashing\HashServiceProvider
{
    public function register()
    {
        $this->app->singleton('hash', function () {
            return new \App\Helpers\Encryption\Pbkdf2Hasher;
        });
    }
}
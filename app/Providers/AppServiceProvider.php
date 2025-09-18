<?php

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function ($app) {
            return new ImageLocalStorage();
        });
    }


    public function boot(): void
    {
        //
    }
}

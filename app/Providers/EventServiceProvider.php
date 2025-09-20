<?php

namespace App\Providers;

use App\Services\CartService;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [],
    ];

    public function boot(): void
    {
        parent::boot();

        // Merge session cart into the persistent user cart on login
        Event::listen(Login::class, function () {
            App::make(CartService::class)->mergeSessionToUserCart();
        });
    }
}

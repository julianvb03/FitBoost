<?php

namespace App\Providers;

use App\Services\CartService;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            // Merge session cart into DB cart on login
            // We use a closure resolved via the container to call the service
            // The default array syntax expects class@method, so we override boot
        ],
    ];

    public function boot(): void
    {
        parent::boot();

        \Illuminate\Support\Facades\Event::listen(Login::class, function () {
            /** @var CartService $service */
            $service = App::make(CartService::class);
            $service->mergeSessionToUserCart();
        });
    }
}

<?php

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Services\CartService;
use App\Util\ImageLocalStorage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function ($app) {
            return new ImageLocalStorage;
        });
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            /** @var CartService $cartService */
            $cartService = app(CartService::class);
            $cartData = $cartService->getCart();
            $view->with('cartItemCount', (int) ($cartData['count'] ?? 0));
        });
    }
}

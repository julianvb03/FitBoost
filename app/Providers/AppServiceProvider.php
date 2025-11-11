<?php

namespace App\Providers;

use App\Interfaces\BmiCalculator;
use App\Interfaces\ImageStorage;
use App\Services\BMI\BmiApiCalculator;
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

        $this->app->bind(BmiCalculator::class, function () {

            return new BmiApiCalculator(config('services.rapidapi_bmi', []));
        });
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $cartService = app(CartService::class);
            $cartData = $cartService->getCart();
            $view->with('cartItemCount', (int) ($cartData['count'] ?? 0));
        });
    }
}

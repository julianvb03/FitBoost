<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', 'App\\Http\\Controllers\\HomeController@index')->name('home.index');

// Language Change Route
Route::post('/language/change', 'App\\Http\\Controllers\\LanguageController@change')->name('language.change');

// Admin Supplement Routes
Route::prefix('admin/supplements')->name('admin.supplements.')->group(function () {

    Route::get('/', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@index')->name('index');
    Route::get('/create', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@create')->name('create');
    Route::post('/', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@store')->name('store');
    Route::delete('/{id}', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@delete')->name('delete');
    Route::get('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@edit')->name('edit');
    Route::patch('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@update')->name('update');
});

// Admin Category Routes
Route::prefix('admin/categories')->name('admin.categories.')->group(function () {

    Route::get('/', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@index')->name('index');
    Route::get('/create', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@create')->name('create');
    Route::post('/', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@store')->name('store');
    Route::delete('/{id}', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@delete')->name('delete');
    Route::get('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@edit')->name('edit');
    Route::patch('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@update')->name('update');
});

// User Supplement Routes
Route::get('/supplements', 'App\Http\Controllers\SupplementController@index')->name('supplements.index');
Route::get('/supplements/{id}/{page?}', 'App\Http\Controllers\SupplementController@show')->where(['id' => '[0-9]+', 'page' => '[0-9]+'])->defaults('page', 1)->name('supplements.show');

// User Review Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', 'App\Http\Controllers\ReviewController@store')->name('reviews.store');
    Route::put('/reviews/{id}', 'App\Http\Controllers\ReviewController@update')->name('reviews.update');
    Route::delete('/reviews/{id}', 'App\Http\Controllers\ReviewController@delete')->name('reviews.delete');
    Route::post('/reviews/{id}/report', 'App\Http\Controllers\ReviewController@report')->name('reviews.report');
});

// Test Recommendations (web)
Route::get('tests/recommendations/create', 'App\\Http\\Controllers\\TestRecommendationController@create')->name('tests.recommendations.create');
Route::post('tests/recommendations', 'App\\Http\\Controllers\\TestRecommendationController@store')->name('tests.recommendations.store');
Route::get('tests/recommendations/{id}', 'App\\Http\\Controllers\\TestRecommendationController@show')->name('tests.recommendations.show');

// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    // View cart
    Route::get('/', 'App\\Http\\Controllers\\CartController@index')->name('index');

    // Add item to cart
    Route::post('/items', 'App\\Http\\Controllers\\CartController@store')->name('items.store');

    // Update quantity for supplement in cart
    Route::patch('/items/{supplement}', 'App\\Http\\Controllers\\CartController@update')->where(['supplement' => '[0-9]+'])->name('items.update');

    // Remove supplement from cart
    Route::delete('/items/{supplement}', 'App\\Http\\Controllers\\CartController@destroy')->where(['supplement' => '[0-9]+'])->name('items.destroy');

    // Clear cart
    Route::delete('/', 'App\\Http\\Controllers\\CartController@clear')->name('clear');

    // Checkout (requires auth)
    Route::post('/checkout', 'App\\Http\\Controllers\\CartController@checkout')->middleware(['auth'])->name('checkout');
});

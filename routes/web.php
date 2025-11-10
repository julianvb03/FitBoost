<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', 'App\\Http\\Controllers\\HomeController@index')->name('home.index');

// Language Change Route
Route::post('/language/change', 'App\\Http\\Controllers\\LanguageController@change')->name('language.change');

// User Supplement Routes
Route::get('/supplements', 'App\Http\Controllers\SupplementController@index')->name('supplements.index');
Route::get('/supplements/{id}/{page?}', 'App\Http\Controllers\SupplementController@show')->where(['id' => '[0-9]+', 'page' => '[0-9]+'])->defaults('page', 1)->name('supplements.show');

// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {

    Route::get('/', 'App\\Http\\Controllers\\CartController@index')->name('index');
    Route::post('/items', 'App\\Http\\Controllers\\CartController@store')->name('items.store');
    Route::patch('/items/{supplement}', 'App\\Http\\Controllers\\CartController@update')->where(['supplement' => '[0-9]+'])->name('items.update');
    Route::delete('/items/{supplement}', 'App\\Http\\Controllers\\CartController@destroy')->where(['supplement' => '[0-9]+'])->name('items.destroy');
    Route::delete('/', 'App\\Http\\Controllers\\CartController@clear')->name('clear');
    Route::post('/checkout', 'App\\Http\\Controllers\\CartController@checkout')->middleware(['auth'])->name('checkout');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {

    Route::get('/', 'App\\Http\\Controllers\\Admin\\AdminHomeController@home')->name('dashboard');

    // Supplement Routes
    Route::prefix('supplements')->name('supplements.')->group(function () {
        Route::get('/', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@index')->name('index');
        Route::get('/create', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@create')->name('create');
        Route::post('/', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@store')->name('store');
        Route::delete('/{id}', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@delete')->name('delete');
        Route::get('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@edit')->name('edit');
        Route::patch('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminSupplementController@update')->name('update');
    });

    // Category Routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@index')->name('index');
        Route::get('/create', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@create')->name('create');
        Route::post('/', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@store')->name('store');
        Route::delete('/{id}', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@delete')->name('delete');
        Route::get('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@edit')->name('edit');
        Route::patch('/edit/{id}', 'App\\Http\\Controllers\\Admin\\AdminCategoryController@update')->name('update');
    });

});

// User Routes

// Review Routes
Route::group(['prefix' => 'reviews', 'as' => 'reviews.', 'middleware' => ['auth', 'role:user']], function () {
    Route::post('/', 'App\Http\Controllers\ReviewController@store')->name('store');
    Route::put('/{id}', 'App\Http\Controllers\ReviewController@update')->name('update');
    Route::delete('/{id}', 'App\Http\Controllers\ReviewController@delete')->name('delete');
    Route::post('/{id}/report', 'App\Http\Controllers\ReviewController@report')->name('report');
});

Route::group(['prefix' => 'tests', 'as' => 'tests.recommendations.', 'middleware' => ['auth', 'role:user']], function () {
    Route::get('/recommendations/create', 'App\\Http\\Controllers\\TestRecommendationController@create')->name('create');
    Route::post('/recommendations', 'App\\Http\\Controllers\\TestRecommendationController@store')->name('store');
    Route::get('/recommendations/{id}', 'App\\Http\\Controllers\\TestRecommendationController@show')->name('show');
});

// User Profile routes
Route::group(['prefix' => 'profile', 'as' => 'users.'], function () {
    Route::get('/', 'App\\Http\\Controllers\\UserController@show')->name('show');
    Route::get('/edit', 'App\\Http\\Controllers\\UserController@edit')->name('edit');
    Route::patch('/', 'App\\Http\\Controllers\\UserController@update')->name('update');
});

<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

// Language Change Route
Route::post('/language/change', 'App\Http\Controllers\LanguageController@change')->name('language.change');

// Admin Supplement Routes
Route::prefix('admin/supplements')->name('admin.supplements.')->group(function () {

    Route::get('/', 'App\Http\Controllers\Admin\AdminSupplementController@index')->name('index');
    Route::get('/create', 'App\Http\Controllers\Admin\AdminSupplementController@create')->name('create');
    Route::post('/', 'App\Http\Controllers\Admin\AdminSupplementController@store')->name('store');
    Route::delete('/{id}', 'App\Http\Controllers\Admin\AdminSupplementController@delete')->name('delete');
    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\AdminSupplementController@edit')->name('edit');
    Route::patch('/edit/{id}', 'App\Http\Controllers\Admin\AdminSupplementController@update')->name('update');
});

// Admin Category Routes
Route::prefix('admin/categories')->name('admin.categories.')->group(function () {

    Route::get('/', 'App\Http\Controllers\Admin\AdminCategoryController@index')->name('index');
    Route::get('/create', 'App\Http\Controllers\Admin\AdminCategoryController@create')->name('create');
    Route::post('/', 'App\Http\Controllers\Admin\AdminCategoryController@store')->name('store');
    Route::delete('/{id}', 'App\Http\Controllers\Admin\AdminCategoryController@delete')->name('delete');
    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\AdminCategoryController@edit')->name('edit');
    Route::patch('/edit/{id}', 'App\Http\Controllers\Admin\AdminCategoryController@update')->name('update');
});

// User Supplement Routes
Route::get('/supplements', 'App\Http\Controllers\SupplementController@index')->name('supplements.index');
Route::get('/supplements/{id}/{page?}', 'App\Http\Controllers\SupplementController@show')->where(['id' => '[0-9]+', 'page' => '[0-9]+'])->defaults('page', 1)->name('supplements.show');

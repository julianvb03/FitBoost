<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

// Language Change Route
Route::post('/language/change', 'App\Http\Controllers\LanguageController@change')->name('language.change');

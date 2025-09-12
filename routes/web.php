<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::post('/language/change', 'App\Http\Controllers\LanguageController@change')->name('language.change');
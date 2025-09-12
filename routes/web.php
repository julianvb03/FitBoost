<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ($locale = null) {
    if (isset($locale) && in_array($locale, config('app.available_locales'))) {
        app()->setLocale($locale);
    }

    return view('index');
});

Route::post('/language/change', 'App\Http\Controllers\LanguageController@change')->name('language.change');

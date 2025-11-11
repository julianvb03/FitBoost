<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('supplements')->group(function () {
    Route::get('/', 'App\Http\Api\SupplementApiController@index');
    Route::get('/{supplement}', 'App\Http\Api\SupplementApiController@show');
});

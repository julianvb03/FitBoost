<?php

use Illuminate\Support\Facades\Route;

# Authentication Routes
Auth::routes();

# Home Route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

# Language Change Route
Route::post('/language/change', 'App\Http\Controllers\LanguageController@change')->name('language.change');

# Testing Authorization (Roles & Permissions)
Route::get('/test-authorization', function () {
    $user = auth()->user();
    if ($user) {
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions()->pluck('name');
        return response()->json([
            'user' => $user->name,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    } else {
        return response()->json(['message' => 'No authenticated user'], 401);
    }
})->name('test.authorization')->middleware('role:admin|user');
<?php

use App\Http\Controllers\Mantenice\RoleController;
use App\Http\Controllers\Mantenice\UserController;
use Illuminate\Support\Facades\Route;



foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Auth::routes();
        Route::get('/', function () {
            return view('welcome');
        });
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(['middleware' => ['auth']], function () {
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);
        });
    });
}

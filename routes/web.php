<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DharamshalaController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Userauth;
use App\Http\Middleware\DisableBackBtn;


Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'Adminogin')->name('admin');
    Route::post('admin-login', 'Login')->name('admin-login');
    Route::post('admin/logout', 'Logout')->name('logout');
});

Route::middleware(['auth', Userauth::class, DisableBackBtn::class])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'Dashboard')->name('dashboard');
    });

    Route::controller(DharamshalaController::class)->group(function () {
        Route::get('dharamshala', 'Dharamshala')->name('dharamshala');
        Route::get('add-dharamshala', 'Adddharamshala')->name('add-dharamshala');
    });
});


<?php

use App\Http\Controllers\PartnerwithusCcontroller;
use App\Http\Controllers\PopularritualsController;
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
    Route::get('users', 'Users')->name('users');

});

Route::middleware(['auth', Userauth::class, DisableBackBtn::class])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'Dashboard')->name('dashboard');
    });

    Route::controller(DharamshalaController::class)->group(function () {
        Route::get('dharamshala', 'Dharamshala')->name('dharamshala');
        Route::get('dharamshala-data', 'DharamshalaData')->name('dharamshala.data');
        Route::get('add-dharamshala', 'Adddharamshala')->name('add-dharamshala');
        Route::post('add-store-dharamshala', 'Addstoredharamshala')->name('add-store-dharamshala');
        Route::get('edit-dharamshala/{dharamshala_id}', 'Editdharamshala')->name('edit-dharamshala');
        Route::post('edit-store-dharamshala/{dharamshala_id}', 'Editstoredharamshala')->name('edit-store-dharamshala');
        Route::get('delete-dharamshala/{dharamshala_id}', 'Deletedharamshala')->name('delete-dharamshala');
    });

    Route::controller(PopularritualsController::class)->group(function () {
        Route::get('popular-rituals', 'Popularrituals')->name('popular-rituals');
        Route::get('popular-rituals-data', 'PopularritualsData')->name('popular-rituals.data');
        Route::get('add-popular-rituals', 'Addpopularrituals')->name('add-popular-rituals');
        Route::post('add-store-popular-rituals', 'Addstorepopuarrituals')->name('add-store-popular-rituals');
        Route::get('edit-popular-rituals/{popular_rituals_id}', 'Editpopularrituals')->name('edit-popular-rituals');
        Route::post('edit-store-popular-rituals/{popular_rituals_id}', 'Editstorepopularrituals')->name('edit-store-popular-rituals');
        Route::get('delete-popular-rituals/{popular_rituals_id}', 'deletepopularrituals')->name('delete-popular-rituals');
    });

    Route::controller(PartnerwithusCcontroller::class)->group(function () {
        Route::get('partner-with-us', 'Partnerwithus')->name('partner-with-us');
        Route::get('partner-with-us-data/{partner_with_us_id}', 'ViewPartnerwithus')->name('partner-with-us-data');
    });
});


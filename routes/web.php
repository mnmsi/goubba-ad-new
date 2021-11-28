<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('advertisement_list', [MainController::class, 'getAnalystDataByAdvId'])->name('analytics');

Route::prefix('adv')->middleware(['auth'])->group(function () {
    Route::get('/', [AdvertisementController::class, 'index'])->name('adv.list');
    Route::get('create', [AdvertisementController::class, 'create'])->name('adv.create');
    Route::post('advertisement_store', [AdvertisementController::class, 'store'])->name('adv.store');
    Route::get('details/{slug}', [AdvertisementController::class, 'show'])->name('adv.view');
    Route::get('edit/{slug}', [AdvertisementController::class, 'edit'])->name('adv.edit');
    Route::post('update', [AdvertisementController::class, 'update'])->name('adv.update');
    Route::get('delete/{slug}', [AdvertisementController::class, 'delete'])->name('adv.delete');

    Route::post('check-time-slot', [AdvertisementController::class, 'checkTimeSlot'])->name('adv.check.timeslot');
});

Route::get('forgot-password', [UsersController::class, 'forgotPassword'])->name('forgot.password');
Route::post('forgot-password', [UsersController::class, 'postForgotPassword'])->name('forgot.password');

Route::get('setup-password/{token}', [UsersController::class, 'resetPasswordForm'])->name('set.password.form');
Route::get('reset-password/{token}', [UsersController::class, 'resetPasswordForm'])->name('reset.password.form');
Route::post('reset-password', [UsersController::class, 'resetPassword'])->name('reset.password');

Route::group(['middleware' => ['auth']], function () {

    Route::any('/', [MainController::class, 'index'])->name('dashboard');
    Route::any('/dashboard', [MainController::class, 'index']);
    Route::any('/viewDashboard', [MainController::class, 'loadDashBoard'])->name('view.dashboard');
    Route::any('/viewDashboardAdmin', [MainController::class, 'loadUserDashBoard'])->name('view_user.dashboard.admin');
    Route::any('/viewAdClickUserTable', [MainController::class, 'loadAdClickUserTable'])->name('dashboard.adClickUserTable');

    Route::group(['middleware' => ['admin'], 'prefix' => 'advertiser'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.list');
        Route::get('create', [UsersController::class, 'create'])->name('users.create');
        Route::post('store', [UsersController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::get('details/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::get('delete/{id}', [UsersController::class, 'delete'])->name('users.delete');
    });

    Route::get('users/change-password', [UsersController::class, 'changePasswordForm'])->name('users.changePassword');
    Route::post('users/change-password', [UsersController::class, 'changePassword'])->name('users.changePassword');

    // Route::get('users/{id}', [UsersController::class, 'show'])->name('users.show');

    // Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    // Route::post('users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    // Route::get('users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

});

Route::post('preview', [PreviewController::class, 'preview'])->name('preview');
Route::get('previewShow', [PreviewController::class, 'previewShow'])->name('preview.show');

Route::post('previewEdit', [PreviewController::class, 'previewEdit'])->name('preview.edit');
Route::get('previewShowEdit', [PreviewController::class, 'previewShowEdit'])->name('preview.edit.show');

Route::post('previewEditNewAd', [PreviewController::class, 'previewEditNewAd'])->name('preview.edit.new');
Route::get('previewShowEditNewAd', [PreviewController::class, 'previewShowEditNewAd'])->name('preview.edit.show.new');

Route::post('previewAllAds', [PreviewController::class, 'previewAllAds'])->name('preview.AllAds');
Route::get('previewShowAllAds', [PreviewController::class, 'previewShowAllAds'])->name('preview.AllAds.show');

Route::get('newAdCreateWithBase', function () {
    return view('pages.new_advertisement.create');
});

Route::get('newAdCreate', function () {
    return view('pages.new_advertisement.create-without-base-layout');
});

Route::get('newAdCreateWithBase', [AdvertisementController::class, 'create']);


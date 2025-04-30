<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
// Auth::routes(['register'=>false]);//register one time for admin

//////login page appear for guest which dont login
Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(), // This sets the URL prefix like /en, /fr, etc.
        'middleware' => [
            'localize',                // To use language-specific routes
            'localizationRedirect',    // Redirects to correct locale
            'localeSessionRedirect',   // Saves selected locale in session
            'localeCookieRedirect',    // Saves selected locale in cookie
            'localeViewPath' ,'auth'          // Loads views based on locale folder
        ]
    ],
    function() {

        // Your localized routes go here
        // Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::get('/', function () {
            return view('dashboard');
        });

        Route::get('/empty', function () {
            return view('empty');
        });

Route::resource('grade', 'GradeController');
    }
);










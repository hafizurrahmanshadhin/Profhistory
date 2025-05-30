<?php

use App\Http\Controllers\Web\Backend\Settings\MailSettingsController;
use App\Http\Controllers\Web\Backend\Settings\PrivacyPolicyController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SystemSettingsController;
use App\Http\Controllers\Web\Backend\Settings\TermsAndConditionsController;
use Illuminate\Support\Facades\Route;

//! Route for Profile Settings
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->name('profile.setting');
    Route::patch('/update-profile', 'UpdateProfile')->name('update.profile');
    Route::put('/update-profile-password', 'UpdatePassword')->name('update.Password');
    Route::post('/update-profile-picture', 'UpdateProfilePicture')->name('update.profile.picture');
    Route::post('/update-cover-photo', 'UpdateCoverPhoto')->name('update.cover.photo');
});

//! Route for System Settings
Route::controller(SystemSettingsController::class)->group(function () {
    Route::get('/system-setting', 'index')->name('system.index');
    Route::patch('/system-setting', 'update')->name('system.update');
});

//! Route for Mail Settings
Route::controller(MailSettingsController::class)->group(function () {
    Route::get('/mail-setting', 'index')->name('mail.setting');
    Route::patch('/mail-setting', 'update')->name('mail.update');
});

//! Route for Terms $ Conditions
Route::controller(TermsAndConditionsController::class)->group(function () {
    Route::get('/terms-and-conditions', 'index')->name('terms-and-conditions.index');
    Route::patch('/terms-and-conditions', 'update')->name('terms-and-conditions.update');
});

//! Route for Privacy Policy
Route::controller(PrivacyPolicyController::class)->group(function () {
    Route::get('/privacy-policy', 'index')->name('privacy-policy.index');
    Route::patch('/privacy-policy', 'update')->name('privacy-policy.update');
});

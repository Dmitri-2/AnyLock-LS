<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Unprotected routes
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');

//User protected routes (must be logged in)
Route::middleware('auth')->group(function () {
    Route::get('/userStatus', 'UserController@status')->name('userStatus');
    Route::post('cancel_rental', 'UserController@cancelUserRental')->name('cancelUserRental');

    Route::get('/rent', 'RentController@index')->name('rent');
    Route::post('/rent-attempt', 'RentController@tryRent')->name('tryRent');

    Route::get('/user', 'UserController@viewUserPage')->name('userPage');
    Route::post('/user/update/email', 'UserController@updateUserInfo')->name('updateUserInfo');
    Route::post('/user/update/password', 'UserController@updateUserPassword')->name('updateUserPassword');
    Route::post('/userStatus/renewLocker', 'UserController@renew_locker')->name('renewLocker');
});

//Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', 'AdminController@viewAdminDashboard')->name('adminDashboard');

    Route::get('/lockerIssues', 'AdminController@location_list')->name('lockerIssues');
    Route::post('/lockerIssues/update', 'AdminController@update_status')->name('updateBrokenStatus');
    Route::get('/expiry_list', 'AdminController@expiry_list')->name('expiry_list');

    Route::get('/rentals/all', 'AdminController@viewAllLockers')->name('allRentals');
    Route::get('/rentals/pending', 'AdminController@viewAdminPendingLockerRentalPage')->name('pendingRentals');
    Route::post('/rentals/pending/confirm', 'AdminController@confirmLockerRental')->name('confirmRental');
    Route::post('/rentals/pending/cancel', 'AdminController@cancelLockerRental')->name('cancelRental');

    Route::get('/locations/overview', 'LocationController@adminLocationPage')->name("adminLocations");

    Route::post('/rentals/create/manual', 'AdminController@createRentalManually')->name('adminMakeRental');
    Route::get('/users/all', 'AdminController@viewAllUsers')->name('allUsers');
    Route::post('/users/set-admin', 'AdminController@setUserAdmin')->name('userSetAdmin');

    Route::post('/rentals/checked/confirm', 'AdminController@confirmCheckedOut')->name('checkedOut');
    Route::post('/rentals/cut/confirm', 'AdminController@cutLock')->name('cutLock');
    Route::post('/rentals/update/date', 'AdminController@updateDate')->name('updateDate');


    Route::get('/settings', 'SettingsController@adminSettingsPage')->name("adminSettings");
    Route::get('/settings/view', 'SettingsController@updateSettingPage')->name("viewSetting");
    Route::post('/settings/update', 'SettingsController@updateSettingSubmit')->name("updateSetting");
});

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
Route::get('/rent', 'RentController@index')->name('rent');

//User protected routes (must be logged in)
Route::middleware('auth')->group(function () {
    Route::get('/userStatus', 'UserController@status')->name('userStatus');
	Route::post('/rent-attempt', 'RentController@tryRent')->name('tryRent');
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
});

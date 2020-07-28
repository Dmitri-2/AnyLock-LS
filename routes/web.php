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

Route::post('/rent-attempt', 'RentController@tryRent')->name('tryRent');



//User protected routes (must be logged in)
Route::middleware('auth')->group(function () {
    Route::get('/userStatus', 'UserController@status')->name('userStatus');
});

//Admin routes
Route::prefix('admin')->middleware('auth')->group(function () {
    //TODO: need to change once we have an admin role in code
    Route::get('/dashboard', 'AdminController@viewAdminDashboard')->name('adminDashboard');

    Route::get('/lockerIssues', 'LockerIssuesController@location_list')->name('lockerIssues');
    Route::post('/lockerIssues/update', 'LockerIssuesController@update_status')->name('updateBrokenStatus');

    Route::get('/rentals/all', 'LockerRentalController@viewAllLockers')->name('allRentals');
    Route::get('/rentals/pending', 'LockerRentalController@viewAdminPendingLockerRentalPage')->name('pendingRentals');
    Route::post('/rentals/pending/confirm', 'LockerRentalController@confirmLockerRental')->name('confirmRental');
    Route::post('/rentals/pending/cancel', 'LockerRentalController@cancelLockerRental')->name('cancelRental');
});
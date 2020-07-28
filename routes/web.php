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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//User
Route::get('/userStatus', 'UserController@status')->name('userStatus');

//Admin routes
//TODO: need to change once we have an admin role in code
Route::get('/lockerIssues', 'LockerIssuesController@location_list')->name('lockerIssues');
Route::post('/lockerIssues/update', 'LockerIssuesController@update_status')->name('updateBrokenStatus');
Route::get('/expiry_list', 'LockerIssuesController@expiry_list')->name('expiry_list');

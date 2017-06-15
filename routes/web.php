<?php

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

Route::get('/', 'DashboardController@login');
Route::get('/welcome', 'DashboardController@welcome');
Route::get('/booking', 'TripController@booking');
Route::get('/newbooking', 'TripController@newbooking');
Route::get('/users', 'SignupController@userlist');

Route::post('/signup/validate', 'SignupController@checkemail');
Route::post('/signup/register', 'SignupController@signup');
Route::post('/signup/city', 'SignupController@citylist');
Route::post('/login', 'SignupController@login');
Route::post('/forgot', 'SignupController@forgot');
Route::post('/aprrove', 'SignupController@aprrove');
Route::post('/status', 'SignupController@status');
Route::post('/user_account_details', 'SignupController@user_account_details');

Route::post('/trip_notify', 'TripController@trip_notify');
Route::post('/trip_notify_driver', 'TripController@trip_notify_driver');
Route::post('/createbooking', 'TripController@createbooking');
Route::post('/vehicle_coords', 'TripController@vehicle_coords');
Route::post('/sendsms', 'TripController@sendsms');
Route::post('/weekbar', 'TripController@weekbar');
Route::post('/driver_trip_history', 'TripController@driver_trip_history');
Route::post('/trip_deatils', 'TripController@trip_notify');



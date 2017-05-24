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

Route::get('/', 'DashboardController@welcome');

Route::post('/signup/validate', 'SignupController@checkemail');
Route::post('/signup/register', 'SignupController@signup');
Route::post('/signup/city', 'SignupController@citylist');
Route::post('/login', 'SignupController@login');
Route::post('/forgot', 'SignupController@forgot');
Route::post('/aprrove', 'SignupController@aprrove');
Route::post('/status', 'SignupController@status');

Route::post('/trip_notify', 'TripController@trip_notify');



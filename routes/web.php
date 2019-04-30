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
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/loader','HomeController@redirect');

Route::get('/home', function() {
    return view('master_layout.dashboard');
});

Route::get('/404', function() {
    return view('404.404_Admin');
});
Route::get('/logout','logout@logout');

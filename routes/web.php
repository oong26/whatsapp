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

Route::get('/', 'LoginController@index');

Route::get('dashboard', 'DashboardController@index');

Route::post('login', 'LoginController@login');

Route::get('logout', 'LoginController@logout');

Route::get('msg', 'DashboardController@msg');

Route::get('send-msg', 'DashboardController@sendMsg');

Route::prefix('akun')->group(function(){
    
    Route::get('', 'UserController@index');
    
    Route::get('tambah', 'UserController@add');

    Route::post('store', 'UserController@store');

});

Route::prefix('pasien')->group(function(){
    
    Route::get('', 'PasienController@index');
    
    Route::get('tambah', 'PasienController@add');

    Route::post('store', 'PasienController@store');

});
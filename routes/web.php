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
// Auth::routes();

Route::get('/', 'DashboardController@index');

Route::get('dashboard', 'DashboardController@index');

Route::get('login', 'LoginController@index');

Route::post('login-process', 'LoginController@login');

Route::get('logout', 'LoginController@logout');

Route::get('msg', 'DashboardController@msg');

Route::get('send-msg', 'DashboardController@sendMsg');

Route::get('send-bidan', 'DashboardController@sendBidanMsg');

Route::get('artikel', 'DashboardController@artikel');

Route::post('send-artikel', 'DashboardController@sendArtikel');

Route::prefix('profil')->group(function(){
    
    Route::get('edit/{id}', 'ProfileController@index');

    Route::post('update', 'ProfileController@update');

});

Route::prefix('akun')->group(function(){
    
    Route::get('', 'UserController@index');
    
    Route::get('tambah', 'UserController@add');

    Route::post('store', 'UserController@store');
    
    Route::get('edit/{id}', 'UserController@edit');
    
    Route::get('delete/{id}', 'UserController@delete');

    Route::post('update', 'UserController@update');
    
    Route::get('export', 'UserController@export');

});

Route::prefix('pasien')->group(function(){
    
    Route::get('', 'PasienController@index');
    
    Route::get('tambah', 'PasienController@add');

    Route::post('store', 'PasienController@store');
    
    Route::get('edit/{id}', 'PasienController@edit');
    
    Route::get('delete/{id}', 'PasienController@delete');

    Route::post('update', 'PasienController@update');

    Route::get('export', 'PasienController@export');

    Route::get('by/{desa}/{id}', 'PasienController@getPasienBy');

    Route::get('by-desa/{desa}', 'PasienController@getPasienByDesa');

    Route::get('by-bidan/{id}', 'PasienController@getPasienByBidan');

});

Route::prefix('wewenang')->group(function(){
    
    Route::get('', 'LevelController@index');
    
    Route::get('tambah', 'LevelController@add');

    Route::post('store', 'LevelController@store');
    
    Route::get('edit/{id}', 'LevelController@edit');
    
    Route::get('delete/{id}', 'LevelController@delete');

    Route::post('update', 'LevelController@update');

});

Route::prefix('waktu')->group(function(){
    
    Route::get('', 'WaktuController@index');
    
    Route::get('tambah', 'WaktuController@add');

    Route::post('store', 'WaktuController@store');
    
    Route::get('edit/{id}', 'WaktuController@edit');
    
    Route::get('delete/{id}', 'WaktuController@delete');

    Route::post('update', 'WaktuController@update');

    Route::get('update-active/{id}/{value}', 'WaktuController@updateActive');

});
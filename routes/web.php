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

Route::get('/', 'DashboardController@index');

Route::get('msg', 'DashboardController@msg');

Route::get('msg/send', 'DashboardController@sendMsg');

Route::get('user/add', 'DashboardController@addUser');

Route::post('user/store', 'DashboardController@storeUser');
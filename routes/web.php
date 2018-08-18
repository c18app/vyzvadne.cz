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
Route::get('/', 'IndexController@homepage');
Route::post('/', 'IndexController@newchallenge');
Route::get('admin', 'AdminController@dashboard');
Route::get('admin/{id}/delete', 'AdminController@deleteChallenge');
Route::get('admin/{id}/approve', 'AdminController@approveChallenge');

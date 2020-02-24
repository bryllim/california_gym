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

Route::get('/', ['middleware' => 'guest', function()
{
    return view("welcome");
}]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/assistance', 'HomeController@assistance')->name('assistance')->middleware('auth');
Route::get('/new-beneficiary', 'HomeController@newBeneficiary')->name('new-beneficiary')->middleware('auth');

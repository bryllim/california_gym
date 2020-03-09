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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/members', 'MemberController@index')->name('members');
    Route::post('/member-create', 'MemberController@create')->name('member-create');
    Route::post('/update', 'MemberController@update')->name('member-update');
    Route::post('/initialPayment', 'MemberController@initialPayment')->name('initialPayment');
    Route::get('/member/{id}', 'MemberController@viewMember')->name('viewMember');
    Route::get('/renew/{id}', 'MemberController@renew')->name('renew');
    Route::get('/edit/{id}', 'MemberController@edit')->name('edit');
    Route::post('/extend', 'MemberController@extend')->name('extend');

    Route::get('/newmember', function(){
        return view('newmember');
    })->name('newmember');
    
});



<?php

Route::get('/', 'UserController@showFormLogin')->name('login');
Route::post('/login', 'UserController@actionLogin')->name('actionLogin');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/usuarios', 'UserController@index')->name('users.index');

});
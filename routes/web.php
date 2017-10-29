<?php

Route::get('/', 'UserController@showFormLogin')->name('login');
Route::post('/login', 'UserController@actionLogin')->name('actionLogin');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/usuarios', 'UserController@index')->name('users.index');
    Route::get('/usuarios/formulario', 'UserController@showForm')->name('users.form');
    Route::post('/usuarios/formulario', 'UserController@create')->name('users.create');

});
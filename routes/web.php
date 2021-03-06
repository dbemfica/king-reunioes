<?php

Route::get('/', 'UserController@showFormLogin')->name('login');
Route::post('/login', 'UserController@actionLogin')->name('actionLogin');


Route::group(['middleware' => 'auth'], function () {

    //USER
    Route::get('/logout', 'UserController@actionLogout')->name('actionLogout');
    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/usuarios', 'UserController@index')->name('users.index');
    Route::get('/usuarios/formulario', 'UserController@showForm')->name('users.form');
    Route::post('/usuarios/formulario', 'UserController@create')->name('users.create');
    Route::get('/usuarios/edit/{id}', 'UserController@showEditForm')->name('users.edit');
    Route::put('/usuarios/edit', 'UserController@update')->name('users.update');
    Route::delete('/usuarios/delete', 'UserController@delete')->name('users.delete');

    //ROOM
    Route::get('/salas', 'RoomController@index')->name('rooms.index');
    Route::get('/salas/formulario', 'RoomController@showForm')->name('rooms.form');
    Route::post('/salas/formulario', 'RoomController@create')->name('rooms.create');
    Route::get('/salas/edit/{id}', 'RoomController@showEditForm')->name('rooms.edit');
    Route::put('/salas/edit', 'RoomController@update')->name('rooms.update');
    Route::delete('/salas/delete', 'RoomController@delete')->name('rooms.delete');

    //MEETING
    Route::get('/reunioes', 'MeetingController@index')->name('meetings.index');
    Route::get('/reunioes/formulario/{room?}/{date?}', 'MeetingController@showForm')->name('meetings.form');
    Route::post('/reunioes/formulario', 'MeetingController@create')->name('meetings.create');
    Route::get('/reunioes/edit/{id}', 'MeetingController@showEditForm')->name('meetings.edit');
    Route::put('/reunioes/edit', 'MeetingController@update')->name('meetings.update');
    Route::delete('/reunioes/delete', 'MeetingController@delete')->name('meetings.delete');

});
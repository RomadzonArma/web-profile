<?php
Route::get('/', 'UsersController@index')->name('users')->middleware('rbac:pengguna');
Route::get('/data', 'UsersController@data')->name('users.data')->middleware('rbac:pengguna');
Route::post('/store', 'UsersController@store')->name('users.store')->middleware('rbac:pengguna,2');
Route::patch('/update', 'UsersController@update')->name('users.update')->middleware('rbac:pengguna,3');
Route::patch('/switch', 'UsersController@switchStatus')->name('users.switch')->middleware('rbac:pengguna,3');
Route::delete('/delete', 'UsersController@delete')->name('users.delete')->middleware('rbac:pengguna,4');
Route::patch('/update/roles', 'UsersController@updateRole')->name('users.update.roles')->middleware('rbac:pengguna,3');
Route::patch('/reset-password', 'UsersController@resetPassword')->name('users.reset-password')->middleware('rbac:pengguna,3');
Route::patch('/change-password', 'UsersController@changePassword')->name('users.change-password');

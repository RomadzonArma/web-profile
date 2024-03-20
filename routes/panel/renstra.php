<?php

use Illuminate\Support\Facades\Route;

Route::get('/','RenstraController@index')->name('manajemen_renstra')->middleware('rbac:manajemen_renstra');
Route::get('/data','RenstraController@data')->name('manajemen_renstra.data')->middleware('rbac:manajemen_renstra');
Route::post('/store','RenstraController@store')->name('manajemen_renstra.store')->middleware('rbac:manajemen_renstra,2');
Route::patch('/update','RenstraController@update')->name('manajemen_renstra.update')->middleware('rbac:manajemen_renstra,3');
Route::delete('/delete','RenstraController@destroy')->name('manajemen_renstra.delete')->middleware('rbac:manajemen_renstra,4');
Route::patch('/switch', 'RenstraController@switchStatus')->name('manajemen_renstra.switch')->middleware('rbac:manajemen_renstra,3');


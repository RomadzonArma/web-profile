<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LaboranController@index')->name('laboran')->middleware('rbac:laboran');
Route::get('/data', 'LaboranController@data')->name('laboran.data')->middleware('rbac:laboran');
Route::post('/store', 'LaboranController@store')->name('laboran.store')->middleware('rbac:laboran,2');
Route::patch('/update', 'LaboranController@update')->name('laboran.update')->middleware('rbac:laboran,3');
Route::patch('/switch', 'LaboranController@switchStatus')->name('laboran.switch')->middleware('rbac:laboran,3');
Route::delete('/delete', 'LaboranController@delete')->name('laboran.delete')->middleware('rbac:laboran,4');
Route::get('/get-images/{id}','LaboranController@getImages')->name('laboran.getImages')->middleware('rbac:laboran');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'TasController@index')->name('tas')->middleware('rbac:tas');
Route::get('/data', 'TasController@data')->name('tas.data')->middleware('rbac:tas');
Route::post('/store', 'TasController@store')->name('tas.store')->middleware('rbac:tas,2');
Route::patch('/update', 'TasController@update')->name('tas.update')->middleware('rbac:tas,3');
Route::patch('/switch', 'TasController@switchStatus')->name('tas.switch')->middleware('rbac:tas,3');
Route::delete('/delete', 'TasController@delete')->name('tas.delete')->middleware('rbac:tas,4');
Route::get('/get-images/{id}','TasController@getImages')->name('tas.getImages')->middleware('rbac:tas');

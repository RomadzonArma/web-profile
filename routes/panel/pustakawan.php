<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PustakawanController@index')->name('pustakawan')->middleware('rbac:pustakawan');
Route::get('/data', 'PustakawanController@data')->name('pustakawan.data')->middleware('rbac:pustakawan');
Route::post('/store', 'PustakawanController@store')->name('pustakawan.store')->middleware('rbac:pustakawan,2');
Route::patch('/update', 'PustakawanController@update')->name('pustakawan.update')->middleware('rbac:pustakawan,3');
Route::patch('/switch', 'PustakawanController@switchStatus')->name('pustakawan.switch')->middleware('rbac:pustakawan,3');
Route::delete('/delete', 'PustakawanController@delete')->name('pustakawan.delete')->middleware('rbac:pustakawan,4');
Route::get('/get-images/{id}','PustakawanController@getImages')->name('pustakawan.getImages')->middleware('rbac:pustakawan');

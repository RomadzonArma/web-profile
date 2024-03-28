<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MaklumatController@index')->name('maklumat')->middleware('rbac:maklumat');
Route::get('/data', 'MaklumatController@data')->name('maklumat.data')->middleware('rbac:maklumat');
Route::post('/store', 'MaklumatController@store')->name('maklumat.store')->middleware('rbac:maklumat,2');
Route::patch('/update', 'MaklumatController@update')->name('maklumat.update')->middleware('rbac:maklumat,3');
Route::patch('/switch', 'MaklumatController@switchStatus')->name('maklumat.switch')->middleware('rbac:maklumat,3');
Route::delete('/delete', 'MaklumatController@delete')->name('maklumat.delete')->middleware('rbac:maklumat,4');
Route::get('/get-images','MaklumatController@getImages')->name('maklumat.getImages')->middleware('rbac:maklumat');

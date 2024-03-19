<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'BerprestasiController@index')->name('berprestasi')->middleware('rbac:berprestasi');
Route::get('/data', 'BerprestasiController@data')->name('berprestasi.data')->middleware('rbac:berprestasi');
Route::post('/store', 'BerprestasiController@store')->name('berprestasi.store')->middleware('rbac:berprestasi,2');
Route::patch('/update', 'BerprestasiController@update')->name('berprestasi.update')->middleware('rbac:berprestasi,3');
Route::patch('/switch', 'BerprestasiController@switchStatus')->name('berprestasi.switch')->middleware('rbac:berprestasi,3');
Route::delete('/delete', 'BerprestasiController@delete')->name('berprestasi.delete')->middleware('rbac:berprestasi,4');

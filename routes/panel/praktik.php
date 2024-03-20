<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PraktikBaikController@index')->name('praktik_baik')->middleware('rbac:praktik_baik');
Route::get('/data', 'PraktikBaikController@data')->name('praktik_baik.data')->middleware('rbac:praktik_baik');
Route::post('/store', 'PraktikBaikController@store')->name('praktik_baik.store')->middleware('rbac:praktik_baik,2');
Route::patch('/update', 'PraktikBaikController@update')->name('praktik_baik.update')->middleware('rbac:praktik_baik,3');
Route::patch('/switch', 'PraktikBaikController@switchStatus')->name('praktik_baik.switch')->middleware('rbac:praktik_baik,3');
Route::delete('/delete', 'PraktikBaikController@delete')->name('praktik_baik.delete')->middleware('rbac:praktik_baik,4');

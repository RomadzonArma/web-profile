<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'TendikController@index')->name('tendik')->middleware('rbac:tendik');
Route::get('/data', 'TendikController@data')->name('tendik.data')->middleware('rbac:tendik');
Route::post('/store', 'TendikController@store')->name('tendik.store')->middleware('rbac:tendik,2');
Route::patch('/update', 'TendikController@update')->name('tendik.update')->middleware('rbac:tendik,3');
Route::patch('/switch', 'TendikController@switchStatus')->name('tendik.switch')->middleware('rbac:tendik,3');
Route::delete('/delete', 'TendikController@delete')->name('tendik.delete')->middleware('rbac:tendik,4');

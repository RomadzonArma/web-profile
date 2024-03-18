<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'CeritaController@index')->name('cerita')->middleware('rbac:cerita');
Route::get('/data', 'CeritaController@data')->name('cerita.data')->middleware('rbac:cerita');
Route::post('/store', 'CeritaController@store')->name('cerita.store')->middleware('rbac:cerita,2');
Route::patch('/update', 'CeritaController@update')->name('cerita.update')->middleware('rbac:cerita,3');
Route::patch('/switch', 'CeritaController@switchStatus')->name('cerita.switch')->middleware('rbac:cerita,3');
Route::delete('/delete', 'CeritaController@delete')->name('cerita.delete')->middleware('rbac:cerita,4');

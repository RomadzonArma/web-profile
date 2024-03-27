<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HarlindungController@index')->name('harlindung')->middleware('rbac:harlindung');
Route::get('/data', 'HarlindungController@data')->name('harlindung.data')->middleware('rbac:harlindung');
Route::post('/store', 'HarlindungController@store')->name('harlindung.store')->middleware('rbac:harlindung,2');
Route::patch('/update', 'HarlindungController@update')->name('harlindung.update')->middleware('rbac:harlindung,3');
Route::patch('/switch', 'HarlindungController@switchStatus')->name('harlindung.switch')->middleware('rbac:harlindung,3');
Route::delete('/delete', 'HarlindungController@delete')->name('harlindung.delete')->middleware('rbac:harlindung,4');

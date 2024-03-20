<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AkuntabilitasController@index')->name('akuntabilitas_list')->middleware('rbac:akuntabilitas_list');
Route::get('/data', 'AkuntabilitasController@data')->name('akuntabilitas_list.data')->middleware('rbac:akuntabilitas_list');
Route::post('/store', 'AkuntabilitasController@store')->name('akuntabilitas_list.store')->middleware('rbac:akuntabilitas_list,2');
Route::patch('/update', 'AkuntabilitasController@update')->name('akuntabilitas_list.update')->middleware('rbac:akuntabilitas_list,3');
Route::patch('/switch', 'AkuntabilitasController@switchStatus')->name('akuntabilitas_list.switch')->middleware('rbac:akuntabilitas_list,3');
Route::delete('/delete', 'AkuntabilitasController@delete')->name('akuntabilitas_list.delete')->middleware('rbac:akuntabilitas_list,4');

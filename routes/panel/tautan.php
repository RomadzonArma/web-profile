<?php
Route::get('/', 'TautanController@index')->name('tautan')->middleware('rbac:tautan');
Route::get('/data', 'TautanController@data')->name('tautan.data')->middleware('rbac:tautan');
Route::post('/store', 'TautanController@store')->name('tautan.store')->middleware('rbac:tautan');
Route::get('/edit/{id}', 'TautanController@edit')->name('tautan.edit')->middleware('rbac:tautan');
Route::post('/update/{id}', 'TautanController@update')->name('tautan.update')->middleware('rbac:tautan');
Route::delete('/delete/{id}', 'TautanController@delete')->name('tautan.delete')->middleware('rbac:tautan');
Route::patch('/switch', 'TautanController@switchStatus')->name('tautan.switch')->middleware('rbac:tautan,3');

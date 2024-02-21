<?php
Route::get('/', 'ListkanalController@index')->name('list_kanal')->middleware('rbac:list_kanal');
Route::get('/data', 'ListkanalController@data')->name('list_kanal.data')->middleware('rbac:list_kanal');
Route::post('/store', 'ListkanalController@store')->name('list_kanal.store')->middleware('rbac:list_kanal');
Route::get('/edit/{id}', 'ListkanalController@edit')->name('list_kanal.edit')->middleware('rbac:list_kanal');
Route::post('/update/{id}', 'ListkanalController@update')->name('list_kanal.update')->middleware('rbac:list_kanal');
Route::delete('/delete/{id}', 'ListkanalController@delete')->name('list_kanal.delete')->middleware('rbac:list_kanal');

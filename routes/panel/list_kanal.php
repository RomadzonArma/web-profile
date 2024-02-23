<?php
Route::get('/', 'ListKanalController@index')->name('list_kanal')->middleware('rbac:list_kanal');
Route::get('/data', 'ListKanalController@data')->name('list_kanal.data')->middleware('rbac:list_kanal');
Route::post('/store', 'ListKanalController@store')->name('list_kanal.store')->middleware('rbac:list_kanal');
Route::get('/edit/{id}', 'ListKanalController@edit')->name('list_kanal.edit')->middleware('rbac:list_kanal');
Route::post('/update/{id}', 'ListKanalController@update')->name('list_kanal.update')->middleware('rbac:list_kanal');
Route::delete('/delete/{id}', 'ListKanalController@delete')->name('list_kanal.delete')->middleware('rbac:list_kanal');

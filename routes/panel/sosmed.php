<?php
Route::get('/', 'SosmedController@index')->name('sosmed')->middleware('rbac:sosmed');
Route::get('/data', 'SosmedController@data')->name('sosmed.data')->middleware('rbac:sosmed');
Route::post('/store', 'SosmedController@store')->name('sosmed.store')->middleware('rbac:sosmed');
Route::get('/edit/{id}', 'SosmedController@edit')->name('sosmed.edit')->middleware('rbac:sosmed');
Route::post('/update/{id}', 'SosmedController@update')->name('sosmed.update')->middleware('rbac:sosmed');
Route::delete('/delete/{id}', 'SosmedController@delete')->name('sosmed.delete')->middleware('rbac:sosmed');

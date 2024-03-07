<?php

Route::get('/','PanduanController@index')->name('manajemen_panduan')->middleware('rbac:manajemen_panduan');
Route::get('/data','PanduanController@data')->name('manajemen_panduan.data')->middleware('rbac:manajemen_panduan');
Route::post('/store','PanduanController@store')->name('manajemen_panduan.store')->middleware('rbac:manajemen_panduan,2');
Route::patch('/update','PanduanController@update')->name('manajemen_panduan.update')->middleware('rbac:manajemen_panduan,3');
Route::delete('/delete','PanduanController@destroy')->name('manajemen_panduan.delete')->middleware('rbac:manajemen_panduan,4');
Route::get('/unduhan/download/{id}', 'PanduanController@download')->name('manajemen_panduan.download');


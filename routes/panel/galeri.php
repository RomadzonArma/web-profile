<?php

Route::get('/','GaleriController@index')->name('manajemen_galeri')->middleware('rbac:manajemen_galeri');
Route::get('/data','GaleriController@data')->name('manajemen_galeri.data')->middleware('rbac:manajemen_galeri');
Route::post('/store','GaleriController@store')->name('manajemen_galeri.store')->middleware('rbac:manajemen_galeri,2');
Route::patch('/update','GaleriController@update')->name('manajemen_galeri.update')->middleware('rbac:manajemen_galeri,3');
Route::delete('/delete','GaleriController@destroy')->name('manajemen_galeri.delete')->middleware('rbac:manajemen_galeri,4');
Route::patch('/switch', 'GaleriController@switchStatus')->name('manajemen_galeri.switch')->middleware('rbac:manajemen_galeri,3');
Route::get('/get-images','GaleriController@getImages')->name('manajemen_galeri.getImages')->middleware('rbac:manajemen_galeri');

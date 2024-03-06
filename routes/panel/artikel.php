<?php

Route::get('/','ArtikelController@index')->name('manajemen_artikel')->middleware('rbac:manajemen_artikel');
Route::get('/data','ArtikelController@data')->name('manajemen_artikel.data')->middleware('rbac:manajemen_artikel');
Route::post('/store','ArtikelController@store')->name('manajemen_artikel.store')->middleware('rbac:manajemen_artikel,2');
Route::patch('/update','ArtikelController@update')->name('manajemen_artikel.update')->middleware('rbac:manajemen_artikel,3');
Route::delete('/delete','ArtikelController@destroy')->name('manajemen_artikel.delete')->middleware('rbac:manajemen_artikel,4');



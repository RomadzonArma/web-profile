<?php
Route::get('/', 'BeritaZIWBKController@index')->name('berita_zi_wbk.index')->middleware('rbac:berita_zi_wbk');
Route::get('/data', 'BeritaZIWBKController@data')->name('berita_zi_wbk.data')->middleware('rbac:berita_zi_wbk');
Route::post('/store', 'BeritaZIWBKController@store')->name('berita_zi_wbk.store')->middleware('rbac:berita_zi_wbk');
Route::get('/edit/{id}', 'BeritaZIWBKController@edit')->name('berita_zi_wbk.edit')->middleware('rbac:berita_zi_wbk');
Route::post('/update/{id}', 'BeritaZIWBKController@update')->name('berita_zi_wbk.update')->middleware('rbac:berita_zi_wbk');
Route::delete('/delete/{id}', 'BeritaZIWBKController@delete')->name('berita_zi_wbk.delete')->middleware('rbac:berita_zi_wbk');
Route::get('/tambah_data', 'BeritaZIWBKController@tambah_data')->name('berita_zi_wbk.tambah_data')->middleware('rbac:berita_zi_wbk');
Route::patch('/switch', 'BeritaZIWBKController@switchStatus')->name('berita_zi_wbk.switch')->middleware('rbac:berita_zi_wbk,3');

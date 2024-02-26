<?php
Route::get('/', 'ListBeritaController@index')->name('list_berita')->middleware('rbac:list_berita');
Route::get('/data', 'ListBeritaController@data')->name('list_berita.data')->middleware('rbac:list_berita');
Route::post('/store', 'ListBeritaController@store')->name('list_berita.store')->middleware('rbac:list_berita');
Route::get('/edit/{id}', 'ListBeritaController@edit')->name('list_berita.edit')->middleware('rbac:list_berita');
Route::post('/update/{id}', 'ListBeritaController@update')->name('list_berita.update')->middleware('rbac:list_berita');
Route::delete('/delete/{id}', 'ListBeritaController@delete')->name('list_berita.delete')->middleware('rbac:list_berita');
Route::get('/tambah_data', 'ListBeritaController@tambah_data')->name('list_berita.tambah_data')->middleware('rbac:list_berita');
Route::patch('/switch', 'ListBeritaController@switchStatus')->name('list_berita.switch')->middleware('rbac:list_berita,3');



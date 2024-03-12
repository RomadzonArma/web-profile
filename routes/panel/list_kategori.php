<?php
Route::get('/', 'ListKategoriController@index')->name('list_kategori')->middleware('rbac:list_kategori');
Route::get('/data', 'ListKategoriController@data')->name('list_kategori.data')->middleware('rbac:list_kategori');
Route::post('/store', 'ListKategoriController@store')->name('list_kategori.store')->middleware('rbac:list_kategori');
Route::get('/edit/{id}', 'ListKategoriController@edit')->name('list_kategori.edit')->middleware('rbac:list_kategori');
Route::post('/update/{id}', 'ListKategoriController@update')->name('list_kategori.update')->middleware('rbac:list_kategori');
Route::delete('/delete/{id}', 'ListKategoriController@delete')->name('list_kategori.delete')->middleware('rbac:list_kategori');
Route::patch('/switch', 'ListKategoriController@switchStatus')->name('list_kategori.switch')->middleware('rbac:list_kategori,3');

<?php
Route::get('/', 'SubKategoriController@index')->name('sub_kategori')->middleware('rbac:sub_kategori');
Route::get('/data', 'SubKategoriController@data')->name('sub_kategori.data')->middleware('rbac:sub_kategori');
Route::post('/store', 'SubKategoriController@store')->name('sub_kategori.store')->middleware('rbac:sub_kategori');
Route::get('/edit/{id}', 'SubKategoriController@edit')->name('sub_kategori.edit')->middleware('rbac:sub_kategori');
Route::post('/update/{id}', 'SubKategoriController@update')->name('sub_kategori.update')->middleware('rbac:sub_kategori');
Route::delete('/delete/{id}', 'SubKategoriController@delete')->name('sub_kategori.delete')->middleware('rbac:sub_kategori');
Route::patch('/switch', 'SubKategoriController@switchStatus')->name('sub_kategori.switch')->middleware('rbac:sub_kategori,3');

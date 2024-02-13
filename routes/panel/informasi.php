<?php
Route::get('/', 'InformasiPublikController@index')->name('informasi-publik')->middleware('rbac:informasi_publik');
Route::get('/data', 'InformasiPublikController@data')->name('informasi-publik.data')->middleware('rbac:informasi_publik');
Route::get('/store', 'InformasiPublikController@store')->name('informasi-publik.store')->middleware('rbac:informasi_publik');
Route::get('/update/{id}', 'InformasiPublikController@update')->name('informasi-publik.update')->middleware('rbac:informasi_publik');
Route::post('/do_store', 'InformasiPublikController@do_store')->name('informasi-publik.do_store')->middleware('rbac:informasi_publik');
Route::post('/do_update', 'InformasiPublikController@do_update')->name('informasi-publik.do_update')->middleware('rbac:informasi_publik');
Route::delete('/delete', 'InformasiPublikController@delete')->name('informasi-publik.delete')->middleware('rbac:informasi_publik');

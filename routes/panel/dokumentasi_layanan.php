<?php

Route::get('/','DokumentasiController@index')->name('dokumentasi_layanan')->middleware('rbac:dokumentasi_layanan');
Route::get('/data','DokumentasiController@data')->name('dokumentasi_layanan.data')->middleware('rbac:dokumentasi_layanan');
Route::post('/store','DokumentasiController@store')->name('dokumentasi_layanan.store')->middleware('rbac:dokumentasi_layanan,2');
Route::patch('/update','DokumentasiController@update')->name('dokumentasi_layanan.update')->middleware('rbac:dokumentasi_layanan,3');
Route::delete('/delete','DokumentasiController@destroy')->name('dokumentasi_layanan.delete')->middleware('rbac:dokumentasi_layanan,4');
Route::patch('/switch', 'DokumentasiController@switchStatus')->name('dokumentasi_layanan.switch')->middleware('rbac:dokumentasi_layanan,3');
Route::get('/get-images','DokumentasiController@getImages')->name('dokumentasi_layanan.getImages')->middleware('rbac:dokumentasi_layanan');
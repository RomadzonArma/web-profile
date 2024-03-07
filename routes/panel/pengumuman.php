<?php
Route::get('/list', 'PengumumanController@index')->name('pengumuman')->middleware('rbac:pengumuman');
Route::get('/data', 'PengumumanController@data')->name('pengumuman.data')->middleware('rbac:pengumuman');
Route::post('/store', 'PengumumanController@store')->name('pengumuman.store')->middleware('rbac:pengumuman');
Route::get('/edit/{id}', 'PengumumanController@edit')->name('pengumuman.edit')->middleware('rbac:pengumuman');
Route::post('/update/{id}', 'PengumumanController@update')->name('pengumuman.update')->middleware('rbac:pengumuman');
Route::delete('/delete/{id}', 'PengumumanController@delete')->name('pengumuman.delete')->middleware('rbac:pengumuman');
Route::get('/tambah_data', 'PengumumanController@tambah_data')->name('pengumuman.tambah_data')->middleware('rbac:pengumuman');
Route::patch('/switch', 'PengumumanController@switchStatus')->name('pengumuman.switch')->middleware('rbac:pengumuman,3');

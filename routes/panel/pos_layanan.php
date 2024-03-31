<?php
Route::get('/', 'PosLayananController@index')->name('pos_layanan')->middleware('rbac:pos_layanan');
Route::get('/data', 'PosLayananController@data')->name('pos_layanan.data')->middleware('rbac:pos_layanan');
Route::post('/store', 'PosLayananController@store')->name('pos_layanan.store')->middleware('rbac:pos_layanan');
Route::get('/edit/{id}', 'PosLayananController@edit')->name('pos_layanan.edit')->middleware('rbac:pos_layanan');
Route::post('/update/{id}', 'PosLayananController@update')->name('pos_layanan.update')->middleware('rbac:pos_layanan');
Route::delete('/delete/{id}', 'PosLayananController@delete')->name('pos_layanan.delete')->middleware('rbac:pos_layanan');
Route::patch('/switch', 'PosLayananController@switchStatus')->name('pos_layanan.switch')->middleware('rbac:pos_layanan,3');

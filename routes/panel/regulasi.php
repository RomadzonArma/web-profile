<?php
Route::get('/', 'RegulasiController@index')->name('regulasi')->middleware('rbac:regulasi');
Route::get('/data', 'RegulasiController@data')->name('regulasi.data')->middleware('rbac:regulasi');
Route::post('/store', 'RegulasiController@store')->name('regulasi.store')->middleware('rbac:regulasi,2');
Route::patch('/update', 'RegulasiController@update')->name('regulasi.update')->middleware('rbac:regulasi,3');
Route::patch('/switch', 'RegulasiController@switchStatus')->name('regulasi.switch')->middleware('rbac:regulasi,3');
Route::delete('/delete', 'RegulasiController@delete')->name('regulasi.delete')->middleware('rbac:regulasi,4');

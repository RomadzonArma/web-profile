<?php
Route::get('/', 'LhkpnController@index')->name('lhkpn.index')->middleware('rbac:l_h_k_p_n');
Route::get('/data', 'LhkpnController@data')->name('lhkpn.data')->middleware('rbac:l_h_k_p_n');
Route::post('/lihat_dokumen', 'LhkpnController@lihat_dokumen')->name('lhkpn.lihat_dokumen')->middleware('rbac:l_h_k_p_n');
Route::post('/upload_dokumen', 'LhkpnController@upload_dokumen')->name('lhkpn.upload_dokumen')->middleware('rbac:l_h_k_p_n');
Route::post('/form', 'LhkpnController@form')->name('lhkpn.form')->middleware('rbac:l_h_k_p_n');
Route::post('/store', 'LhkpnController@store')->name('lhkpn.store')->middleware('rbac:l_h_k_p_n');
Route::get('/edit', 'LhkpnController@edit')->name('lhkpn.edit')->middleware('rbac:l_h_k_p_n');
Route::post('/update', 'LhkpnController@update')->name('lhkpn.update')->middleware('rbac:l_h_k_p_n');
Route::delete('/delete', 'LhkpnController@delete')->name('lhkpn.delete')->middleware('rbac:l_h_k_p_n');
Route::delete('/hapus_dokumen', 'LhkpnController@hapus_dokumen')->name('lhkpn.hapus_dokumen')->middleware('rbac:l_h_k_p_n');

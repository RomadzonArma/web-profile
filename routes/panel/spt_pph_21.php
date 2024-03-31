<?php
Route::get('/', 'SptPph21Controller@index')->name('spt_pph_21.index')->middleware('rbac:s_p_t_p_p_h21');
Route::get('/data', 'SptPph21Controller@data')->name('spt_pph_21.data')->middleware('rbac:s_p_t_p_p_h21');
Route::post('/lihat_dokumen', 'SptPph21Controller@lihat_dokumen')->name('spt_pph_21.lihat_dokumen')->middleware('rbac:s_p_t_p_p_h21');
Route::post('/upload_dokumen', 'SptPph21Controller@upload_dokumen')->name('spt_pph_21.upload_dokumen')->middleware('rbac:s_p_t_p_p_h21');
Route::post('/form', 'SptPph21Controller@form')->name('spt_pph_21.form')->middleware('rbac:s_p_t_p_p_h21');
Route::post('/store', 'SptPph21Controller@store')->name('spt_pph_21.store')->middleware('rbac:s_p_t_p_p_h21');
Route::get('/edit', 'SptPph21Controller@edit')->name('spt_pph_21.edit')->middleware('rbac:s_p_t_p_p_h21');
Route::post('/update', 'SptPph21Controller@update')->name('spt_pph_21.update')->middleware('rbac:s_p_t_p_p_h21');
Route::delete('/delete', 'SptPph21Controller@delete')->name('spt_pph_21.delete')->middleware('rbac:s_p_t_p_p_h21');
Route::delete('/hapus_dokumen', 'SptPph21Controller@hapus_dokumen')->name('spt_pph_21.hapus_dokumen')->middleware('rbac:s_p_t_p_p_h21');

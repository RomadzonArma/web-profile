<?php

Route::get('/', 'ProgramLayananController@index')->name('program_layanan')->middleware('rbac:program_layanan');
Route::get('/data', 'ProgramLayananController@data')->name('program_layanan.data')->middleware('rbac:program_layanan');
Route::get('/create', 'ProgramLayananController@create')->name('program_layanan.create')->middleware('rbac:program_layanan, 2');
Route::get('/edit/{id}', 'ProgramLayananController@edit')->name('program_layanan.edit')->middleware('rbac:program_layanan, 3');
Route::post('/store', 'ProgramLayananController@store')->name('program_layanan.store')->middleware('rbac:program_layanan,2');
Route::post('/update/{id}', 'ProgramLayananController@update')->name('program_layanan.update')->middleware('rbac:program_layanan, 3');
Route::delete('/delete', 'ProgramLayananController@destroy')->name('program_layanan.delete')->middleware('rbac:program_layanan');
Route::get('/show/{id}','ProgramLayananController@show')->name('program_layanan.show')->middleware('rbac:program_layanan');
Route::patch('/switch','ProgramLayananController@switchStatus')->name('program_layanan.switch')->middleware('rbac:program_layanan,3');

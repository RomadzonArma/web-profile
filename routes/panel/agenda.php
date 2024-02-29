<?php
Route::get('/', 'AgendaController@index')->name('list_agenda')->middleware('rbac:list_agenda');
Route::get('/data', 'AgendaController@data')->name('list_agenda.data')->middleware('rbac:list_agenda');
Route::post('/store', 'AgendaController@store')->name('list_agenda.store')->middleware('rbac:list_agenda');
Route::get('/edit/{id}', 'AgendaController@edit')->name('list_agenda.edit')->middleware('rbac:list_agenda');
Route::post('/update/{id}', 'AgendaController@update')->name('list_agenda.update')->middleware('rbac:list_agenda');
Route::delete('/delete/{id}', 'AgendaController@delete')->name('list_agenda.delete')->middleware('rbac:list_agenda');
Route::get('/tambah_data', 'AgendaController@tambah_data')->name('list_agenda.tambah_data')->middleware('rbac:list_agenda');
Route::patch('/switch', 'AgendaController@switchStatus')->name('list_agenda.switch')->middleware('rbac:list_agenda,3');

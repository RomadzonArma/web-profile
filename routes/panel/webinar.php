<?php
Route::get('/list', 'WebinarController@index')->name('webinar')->middleware('rbac:webinar');
Route::get('/data', 'WebinarController@data')->name('webinar.data')->middleware('rbac:webinar');
Route::post('/store', 'WebinarController@store')->name('webinar.store')->middleware('rbac:webinar');
Route::get('/edit/{id}', 'WebinarController@edit')->name('webinar.edit')->middleware('rbac:webinar');
Route::post('/update/{id}', 'WebinarController@update')->name('webinar.update')->middleware('rbac:webinar');
Route::delete('/delete/{id}', 'WebinarController@delete')->name('webinar.delete')->middleware('rbac:webinar');
Route::get('/tambah_data', 'WebinarController@tambah_data')->name('webinar.tambah_data')->middleware('rbac:webinar');
Route::patch('/switch', 'WebinarController@switchStatus')->name('webinar.switch')->middleware('rbac:webinar,3');

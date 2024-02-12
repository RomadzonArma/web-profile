<?php
Route::get('/', 'OtoritasController@index')->name('otoritas')->middleware('rbac:otoritas');
Route::get('/data', 'OtoritasController@data')->name('otoritas.data')->middleware('rbac:otoritas');
Route::post('/store', 'OtoritasController@store')->name('otoritas.store')->middleware('rbac:otoritas,2');
Route::patch('/update', 'OtoritasController@update')->name('otoritas.update')->middleware('rbac:otoritas,3');
Route::delete('/delete', 'OtoritasController@delete')->name('otoritas.delete')->middleware('rbac:otoritas,4');

Route::get('/permission/{slug}', 'OtoritasController@formPermission')->name('otoritas.open.permission')->middleware('rbac:otoritas,3');
Route::patch('/permission', 'OtoritasController@submitPermission')->name('otoritas.submit.permission')->middleware('rbac:otoritas,3');

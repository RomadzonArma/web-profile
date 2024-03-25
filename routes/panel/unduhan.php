<?php

Route::get('/','UnduhanController@index')->name('manajemen_unduhan')->middleware('rbac:unduhan');
Route::get('/data','UnduhanController@data')->name('manajemen_unduhan.data')->middleware('rbac:unduhan');
Route::post('/store','UnduhanController@store')->name('manajemen_unduhan.store')->middleware('rbac:unduhan,2');
// Route::get('/edit/{id}', 'UnduhanController@edit')->name('manajemen_unduhan.edit')->middleware('rbac:unduhan,3');
Route::patch('/update','UnduhanController@update')->name('manajemen_unduhan.update')->middleware('rbac:unduhan,3');
Route::delete('/delete','UnduhanController@destroy')->name('manajemen_unduhan.delete')->middleware('rbac:unduhan,4');
Route::get('/unduhan/download/{id}', 'UnduhanController@download')->name('unduhan.download');
Route::patch('/switch','UnduhanController@switchStatus')->name('unduhan.switch')->middleware('rbac:unduhan,3');

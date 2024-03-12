<?php
Route::get('/', 'ZiWbkController@index')->name('zi_wbk')->middleware('rbac:zi_wbk');
Route::get('/data', 'ZiWbkController@data')->name('zi_wbk.data')->middleware('rbac:zi_wbk');
Route::post('/store', 'ZiWbkController@store')->name('zi_wbk.store')->middleware('rbac:zi_wbk');
Route::get('/edit/{id}', 'ZiWbkController@edit')->name('zi_wbk.edit')->middleware('rbac:zi_wbk');
Route::post('/update/{id}', 'ZiWbkController@update')->name('zi_wbk.update')->middleware('rbac:zi_wbk');
Route::delete('/delete/{id}', 'ZiWbkController@delete')->name('zi_wbk.delete')->middleware('rbac:zi_wbk');
Route::patch('/switch', 'ZiWbkController@switchStatus')->name('zi_wbk.switch')->middleware('rbac:zi_wbk,3');

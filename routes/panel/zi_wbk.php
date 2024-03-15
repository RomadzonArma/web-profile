<?php
Route::get('/', 'ZiWbkController@index')->name('zi_wbk')->middleware('rbac:zi_wbk');
Route::get('/data', 'ZiWbkController@data')->name('zi_wbk.data')->middleware('rbac:zi_wbk');
Route::post('/store', 'ZiWbkController@store')->name('zi_wbk.store')->middleware('rbac:zi_wbk,2');
Route::get('/edit', 'ZiWbkController@edit')->name('zi_wbk.edit')->middleware('rbac:zi_wbk');
Route::patch('/update', 'ZiWbkController@update')->name('zi_wbk.update')->middleware('rbac:zi_wbk,3',);
Route::delete('/delete', 'ZiWbkController@destroy')->name('zi_wbk.delete')->middleware('rbac:zi_wbk,4');
Route::patch('/switch', 'ZiWbkController@switchStatus')->name('zi_wbk.switch')->middleware('rbac:zi_wbk,3');
Route::get('/get-link', 'ZiWbkController@data')->name('zi_wbk.get-link')->middleware('rbac:zi_wbk');

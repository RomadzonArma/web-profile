<?php
Route::get('/', 'FaqController@index')->name('faq')->middleware('rbac:faq');
Route::get('/data', 'FaqController@data')->name('faq.data')->middleware('rbac:faq');
// Route::post('/store', 'FaqController@store')->name('faq.store')->middleware('rbac:faq');
Route::get('/edit/{id}', 'FaqController@edit')->name('faq.edit')->middleware('rbac:faq');
Route::post('/update/{id}', 'FaqController@update')->name('faq.update')->middleware('rbac:faq');
Route::delete('/delete/{id}', 'FaqController@delete')->name('faq.delete')->middleware('rbac:faq');
Route::patch('/switch', 'FaqController@switchStatus')->name('faq.switch')->middleware('rbac:faq,3');

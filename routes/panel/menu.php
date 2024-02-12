<?php
Route::get('/', 'MenusController@index')->name('manajemen-menu')->middleware('rbac:manajemen_menu');
Route::get('/data', 'MenusController@data')->name('manajemen-menu.data')->middleware('rbac:manajemen_menu');
Route::post('/store', 'MenusController@store')->name('manajemen-menu.store')->middleware('rbac:manajemen_menu,2');
Route::patch('/update', 'MenusController@update')->name('manajemen-menu.update')->middleware('rbac:manajemen_menu,3');
Route::delete('/delete', 'MenusController@delete')->name('manajemen-menu.delete')->middleware('rbac:manajemen_menu,4');

Route::get('/get/main-menu', 'MenusController@getMainMenu')->name('manajemen-menu.get.main-menu')->middleware('rbac:manajemen_menu');

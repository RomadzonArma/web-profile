<?php

Route::get('/', 'ProfilController@index')->name('profil')->middleware('rbac:profil');
Route::get('/data', 'ProfilController@data')->name('profil.data')->middleware('rbac:profil');
Route::get('/store', 'ProfilController@store')->name('profil.store')->middleware('rbac:profil');
Route::get('/update/{id}', 'ProfilController@update')->name('profil.update')->middleware('rbac:profil');
Route::post('/do_store', 'ProfilController@do_store')->name('profil.do_store')->middleware('rbac:profil');
Route::post('/do_update/{id}', 'ProfilController@do_update')->name('profil.do_update')->middleware('rbac:profil');
Route::delete('/delete', 'ProfilController@delete')->name('profil.delete')->middleware('rbac:profil');
Route::patch('/switch', 'ProfilController@switchStatus')->name('profil.switch')->middleware('rbac:profil');

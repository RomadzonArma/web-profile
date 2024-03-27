<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PengaduanController@index')->name('pengaduan')->middleware('rbac:pengaduan');
Route::get('/data', 'PengaduanController@data')->name('pengaduan.data')->middleware('rbac:pengaduan');
Route::post('/store', 'PengaduanController@store')->name('pengaduan.store')->middleware('rbac:pengaduan');
Route::get('/edit/{id}', 'PengaduanController@edit')->name('pengaduan.edit')->middleware('rbac:pengaduan');
Route::post('/update/{id}', 'PengaduanController@update')->name('pengaduan.update')->middleware('rbac:pengaduan');
Route::delete('/delete/{id}', 'PengaduanController@delete')->name('pengaduan.delete')->middleware('rbac:pengaduan');
Route::patch('/switch', 'PengaduanController@switchStatus')->name('pengaduan.switch')->middleware('rbac:pengaduan,3');

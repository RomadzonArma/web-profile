<?php
Route::get('/', 'InformasiPublikController@index')->name('informasi-publik')->middleware('rbac:informasi_publik');

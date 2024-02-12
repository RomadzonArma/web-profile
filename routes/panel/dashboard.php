<?php
Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('rbac:beranda');

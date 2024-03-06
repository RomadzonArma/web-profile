<?php
Route::get('/', 'ProgramFokusController@index')->name('program_fokus')->middleware('rbac:program_fokus');
Route::get('/data', 'ProgramFokusController@data')->name('program_fokus.data')->middleware('rbac:program_fokus');
Route::post('/store', 'ProgramFokusController@store')->name('program_fokus.store')->middleware('rbac:program_fokus,2');
Route::patch('/update', 'ProgramFokusController@update')->name('program_fokus.update')->middleware('rbac:program_fokus,3');
Route::patch('/switch', 'ProgramFokusController@switchStatus')->name('program_fokus.switch')->middleware('rbac:program_fokus,3');
Route::delete('/delete', 'ProgramFokusController@delete')->name('program_fokus.delete')->middleware('rbac:program_fokus,4');

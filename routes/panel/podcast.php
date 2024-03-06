<?php
Route::get('/list', 'PodcastController@index')->name('podcast')->middleware('rbac:podcast');
Route::get('/data', 'PodcastController@data')->name('podcast.data')->middleware('rbac:podcast');
Route::post('/store', 'PodcastController@store')->name('podcast.store')->middleware('rbac:podcast');
Route::get('/edit/{id}', 'PodcastController@edit')->name('podcast.edit')->middleware('rbac:podcast');
Route::post('/update/{id}', 'PodcastController@update')->name('podcast.update')->middleware('rbac:podcast');
Route::delete('/delete/{id}', 'PodcastController@delete')->name('podcast.delete')->middleware('rbac:podcast');
Route::patch('/switch', 'PodcastController@switchStatus')->name('podcast.switch')->middleware('rbac:podcast,3');

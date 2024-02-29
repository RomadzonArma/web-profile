<?php
Route::get('/', 'SwiperController@index')->name('swiper')->middleware('rbac:swiper');
Route::get('/data', 'SwiperController@data')->name('swiper.data')->middleware('rbac:swiper');
Route::post('/store', 'SwiperController@store')->name('swiper.store')->middleware('rbac:swiper,2');
Route::patch('/update', 'SwiperController@update')->name('swiper.update')->middleware('rbac:swiper,3');
Route::patch('/switch', 'SwiperController@switchStatus')->name('swiper.switch')->middleware('rbac:swiper,3');
Route::delete('/delete', 'SwiperController@delete')->name('swiper.delete')->middleware('rbac:swiper,4');

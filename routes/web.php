<?php

Route::prefix('satuan')->group(function(){
	Route::get('/', 'SatuanController@index')->name('satuan');
	Route::get('/tambah', 'SatuanController@create')->name('satuan.tambah');
	Route::post('/tambah', 'SatuanController@store')->name('satuan.store');
	Route::get('/ubah/{satuan}', 'SatuanController@edit')->name('satuan.ubah');
	Route::put('/ubah/{satuan}', 'SatuanController@update')->name('satuan.update');
	Route::delete('/{satuan}', 'SatuanController@destroy')->name('satuan.destroy');
});

Route::prefix('rekening')->group(function(){
	Route::get('/', 'RekeningController@index')->name('rekening');
	Route::get('/tambah', 'RekeningController@create')->name('rekening.tambah');
	Route::post('/tambah', 'RekeningController@store')->name('rekening.store');
	Route::get('/ubah/{rekening}', 'RekeningController@edit')->name('rekening.ubah');
	Route::put('/ubah/{rekening}', 'RekeningController@update')->name('rekening.update');
	Route::delete('/{rekening}', 'RekeningController@destroy')->name('rekening.destroy');
});
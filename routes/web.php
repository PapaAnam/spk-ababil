<?php

Route::middleware('auth')->group(function(){

	Route::get('/', function(){
		return redirect()->route('karyawan.index');
	});

	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::put('/profile', 'ProfileController@update')->name('profile.update');

	Route::prefix('satuan')->middleware('myrole:superadmin')->group(function(){
		Route::get('/', 'SatuanController@index')->name('satuan');
		Route::get('/tambah', 'SatuanController@create')->name('satuan.tambah');
		Route::post('/tambah', 'SatuanController@store')->name('satuan.store');
		Route::get('/ubah/{satuan}', 'SatuanController@edit')->name('satuan.ubah');
		Route::put('/ubah/{satuan}', 'SatuanController@update')->name('satuan.update');
		Route::delete('/{satuan}', 'SatuanController@destroy')->name('satuan.destroy');
	});

	Route::prefix('rekening')->group(function(){
		Route::get('/', 'RekeningController@index')->name('rekening')->middleware('myrole:superadmin,finance');
		Route::middleware('myrole:superadmin')->group(function(){
			Route::get('/tambah', 'RekeningController@create')->name('rekening.tambah');
			Route::post('/tambah', 'RekeningController@store')->name('rekening.store');
			Route::get('/ubah/{rekening}', 'RekeningController@edit')->name('rekening.ubah');
			Route::put('/ubah/{rekening}', 'RekeningController@update')->name('rekening.update');
			Route::delete('/{rekening}', 'RekeningController@destroy')->name('rekening.destroy');
		});
	});

	Route::resource('vendor', 'VendorController')->except(['show']);
	Route::resource('uam', 'UamController')->except(['show']);
	Route::resource('karyawan', 'KaryawanController')->except(['show']);
	Route::resource('klien', 'KlienController')->except(['show']);
	Route::resource('time-sheet', 'TimeSheetController')->except(['show']);
	Route::resource('proyek', 'ProyekController')->except(['show']);
	Route::resource('tugas', 'TugasController')->except(['show']);
	Route::resource('progress-kerja-harian', 'ProgressKerjaHarianController')->except(['show']);
	Route::resource('invoice', 'InvoiceController')->only(['index','create','store']);
	Route::resource('kategori', 'KategoriController')->except(['show']);
	Route::get('/sub-kategori/{kategori}/tambah', 'SubKategoriController@create')->name('sub-kategori.create');
	Route::post('/sub-kategori/{kategori}', 'SubKategoriController@store')->name('sub-kategori.store');
	Route::get('/sub-kategori/{kategori}/{sub_kategori}/ubah', 'SubKategoriController@edit')->name('sub-kategori.edit');
	Route::put('/sub-kategori/{kategori}/{sub_kategori}', 'SubKategoriController@update')->name('sub-kategori.update');
	Route::delete('/sub-kategori/{kategori}/{sub_kategori}', 'SubKategoriController@destroy')->name('sub-kategori.destroy');

	Route::get('/home', function(){
		return redirect()->route('karyawan.index');
	});

	Route::get('/keluar', 'Auth\LoginController@logout');

});

Auth::routes();
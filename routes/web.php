<?php

Route::middleware('auth')->group(function(){

	Route::get('/', 'DasborController@index')->name('dasbor');

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
	Route::resource('karyawan', 'KaryawanController');
	Route::resource('klien', 'KlienController')->except(['show']);
	Route::get('time-sheet/by-waktu', 'TimeSheetController@byWaktu')->name('time-sheet.by-waktu');
	Route::get('time-sheet/by-karyawan', 'TimeSheetController@byKaryawan')->name('time-sheet.by-karyawan');
	Route::resource('time-sheet', 'TimeSheetController')->except(['show', 'index']);
	Route::get('proyek/by-waktu', 'ProyekController@byWaktu')->name('proyek.by-waktu');
	Route::get('proyek/by-klien', 'ProyekController@byKlien')->name('proyek.by-klien');
	Route::resource('proyek', 'ProyekController')->except('index');
	Route::resource('tugas', 'TugasController')->except(['show']);
	Route::get('/tugas-select', 'TugasController@select');
	Route::get('/tugas-detail', 'TugasController@detail');
	Route::get('/tugas/by-waktu', 'TugasController@byWaktu')->name('tugas.by-waktu');
	Route::get('/tugas/by-klien', 'TugasController@byKlien')->name('tugas.by-klien');
	Route::get('/tugas/by-proyek', 'TugasController@byProyek')->name('tugas.by-proyek');
	Route::resource('progress-kerja-harian', 'ProgressKerjaHarianController')->except(['show']);
	Route::get('/invoice/by-proyek', 'InvoiceController@byProyek')->name('invoice.by-proyek');
	Route::get('/invoice/by-klien', 'InvoiceController@byKlien')->name('invoice.by-klien');
	Route::get('/invoice/by-waktu', 'InvoiceController@byWaktu')->name('invoice.by-waktu');
	Route::resource('invoice', 'InvoiceController')->except(['index']);
	Route::resource('kategori', 'KategoriController')->except(['show']);
	Route::get('/sub-kategori/{kategori}/tambah', 'SubKategoriController@create')->name('sub-kategori.create');
	Route::post('/sub-kategori/{kategori}', 'SubKategoriController@store')->name('sub-kategori.store');
	Route::get('/sub-kategori/{kategori}/{sub_kategori}/ubah', 'SubKategoriController@edit')->name('sub-kategori.edit');
	Route::put('/sub-kategori/{kategori}/{sub_kategori}', 'SubKategoriController@update')->name('sub-kategori.update');
	Route::delete('/sub-kategori/{kategori}/{sub_kategori}', 'SubKategoriController@destroy')->name('sub-kategori.destroy');
	Route::resource('pengeluaran', 'PengeluaranController')->except(['show']);
	Route::get('/pengeluaran/by-waktu', 'PengeluaranController@byWaktu')->name('pengeluaran.by-waktu');
	Route::get('/pengeluaran/by-proyek', 'PengeluaranController@byProyek')->name('pengeluaran.by-proyek');
	Route::get('/pengeluaran/by-kategori', 'PengeluaranController@byKategori')->name('pengeluaran.by-kategori');
	Route::get('/pengeluaran/by-pelaksana', 'PengeluaranController@byPelaksana')->name('pengeluaran.by-pelaksana');
	Route::get('/pengeluaran/by-vendor', 'PengeluaranController@byVendor')->name('pengeluaran.by-vendor');
	Route::get('/gaji/cek', 'GajiController@cek')->name('gaji.cek');
	Route::get('/gaji/by-karyawan', 'GajiController@byKaryawan')->name('gaji.by-karyawan');
	Route::get('/gaji/by-periode', 'GajiController@byPeriode')->name('gaji.by-periode');
	Route::get('/gaji/by-jabatan', 'GajiController@byJabatan')->name('gaji.by-jabatan');
	Route::resource('gaji', 'GajiController');

	Route::get('/home', function(){
		return redirect('/');
	});

	Route::get('/keluar', 'Auth\LoginController@logout');

});

Auth::routes();
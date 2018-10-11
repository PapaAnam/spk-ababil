<?php

Route::get('/proyek', 'ProyekController@get');
Route::get('/sub-kategori', 'SubKategoriController@getData');
Route::get('/karyawan','KaryawanController@get');
Route::get('/insentif','TimeSheetController@insentifApi');
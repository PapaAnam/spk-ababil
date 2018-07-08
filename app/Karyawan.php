<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{

	public $timestamps = false;
	protected $table = 'karyawan';
	protected $fillable = ['nama','nik','alamat','no_hp','no_darurat','jabatan','armada','gaji_pokok','rate_per_jam','um_harian','rate_lembur','insentif',
	];
}

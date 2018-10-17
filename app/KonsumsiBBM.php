<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KonsumsiBBM extends Model
{

	protected $table = 'konsumsi_bbm';

	public $timestamps = false;

	protected $fillable = [
		'tanggal_masuk',
		'tanggal_keluar',
		'qty_masuk',
		'qty_keluar',
		'keterangan_masuk',
		'keterangan_keluar',
		'id_vendor',
		'id_karyawan',
		'id_armada',
		'id_proyek',
	];

	public function armada()
	{
		return $this->belongsTo('App\Armada','id_armada');
	}

	public function proyek()
	{
		return $this->belongsTo('App\Proyek','id_proyek');
	}

	public function vendor()
	{
		return $this->belongsTo('App\Vendor','id_vendor');
	}

	public function pelaksana()
	{
		return $this->belongsTo('App\Karyawan','id_karyawan');
	}

}

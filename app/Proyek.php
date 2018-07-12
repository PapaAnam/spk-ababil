<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
	public $timestamps = false;
	protected $table = 'proyek';
	protected $fillable = [
		'nama',
		'klien',
		'deskripsi',
		'qty',
		'satuan',
		'start_date',
		'end_date',
	];

	public function pelaksana()
	{
		return $this->hasMany('App\PelaksanaDetail', 'id_proyek');
	}

	public function kliendetail()
	{
		return $this->belongsTo('App\Klien', 'klien');
	}
}

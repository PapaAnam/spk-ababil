<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelaksanaDetail extends Model
{
    public $timestamps = false;
	protected $table = 'pelaksana_detail';
	protected $fillable = [
		'id_pelaksana',
		'id_proyek'
	];

	public function karyawan()
	{
		return $this->belongsTo('App\Karyawan', 'id_pelaksana');
	}
}

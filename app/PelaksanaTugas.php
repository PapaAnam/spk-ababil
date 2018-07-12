<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelaksanaTugas extends Model
{
    public $timestamps = false;
	protected $table = 'pelaksana_tugas';
	protected $fillable = [
		'id_pelaksana',
		'id_tugas'
	];

	public function karyawan()
	{
		return $this->belongsTo('App\Karyawan', 'id_pelaksana');
	}
}

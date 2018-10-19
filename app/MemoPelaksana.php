<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemoPelaksana extends Model
{

	protected $table = 'memo_jenis_karyawan';

	protected $fillable = [
		'id_memo',
		'id_karyawan',
	];

	public function karyawan()
	{
		return $this->belongsTo('App\Karyawan','id_karyawan');
	}

}

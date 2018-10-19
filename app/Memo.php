<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{

	protected $table = 'memo';

	protected $fillable = [
		'pesan',
		'tanggal',
		'deadline',
		'id_klien',
		'id_proyek',
	];

	public function pelaksana()
	{
		return $this->hasMany('App\MemoPelaksana', 'id_memo');
	}

	public function jeniskaryawan()
	{
		return $this->hasMany('App\MemoJenisKaryawan', 'id_memo');
	}

	public function klien()
	{
		return $this->belongsTo('App\Klien','id_klien');
	}

	public function proyek()
	{
		return $this->belongsTo('App\Proyek','id_proyek');
	}

}

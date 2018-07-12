<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    public $timestamps = false;
	protected $table = 'tugas';
	protected $fillable = [
		'id_proyek',
		'deskripsi',
		'qty',
		'satuan',
		'start_date',
		'end_date',
	];

	public function pelaksana()
	{
		return $this->hasMany('App\PelaksanaTugas', 'id_tugas');
	}

	public function proyek()
	{
		return $this->belongsTo('App\Proyek', 'id_proyek');
	}

	public function satuandetail()
	{
		return $this->belongsTo('App\Satuan','satuan');
	}
}

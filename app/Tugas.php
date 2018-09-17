<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mytrait\Tanggal;

class Tugas extends Model
{

use Tanggal;

    public $timestamps = false;
	protected $table = 'tugas';
	protected $fillable = [
		'id_proyek',
		'nama_tugas',
		'deskripsi',
		'material',
		'qty',
		'satuan',
		'start_date',
		'end_date',
	];

	protected $appends = [
		'start_date_indo',
		'end_date_indo',
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

	public function getStartDateIndoAttribute()
	{
		return $this->tglIndo($this->start_date);
	}

	public function getEndDateIndoAttribute()
	{
		return $this->tglIndo($this->end_date);
	}
}

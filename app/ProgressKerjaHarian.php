<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mytrait\Tanggal;

class ProgressKerjaHarian extends Model
{

use Tanggal;

	public $timestamps = false;
	protected $table = 'progress_kerja_harian';
	protected $fillable = [
		'tanggal',
		'id_proyek',
		'deskripsi',
		'ritase',
		'cuaca',
		'kendala',
		'id_tugas',
		'qty'
	];

	protected $appends = [
		'tanggal_indo'
	];

	public function proyek()
	{
		return $this->belongsTo('App\Proyek', 'id_proyek');
	}

	public function tugas()
	{
		return $this->belongsTo('App\Tugas', 'id_tugas');
	}
	
	public function getTanggalIndoAttribute()
	{
		return $this->tglIndo($this->tanggal);
	}
}

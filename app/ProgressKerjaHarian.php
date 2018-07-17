<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressKerjaHarian extends Model
{
	public $timestamps = false;
	protected $table = 'progress_kerja_harian';
	protected $fillable = [
		'tanggal',
		'id_proyek',
		'deskripsi',
		'ritase',
		'cuaca',
		'kendala',
	];

	public function proyek()
	{
		return $this->belongsTo('App\Proyek', 'id_proyek');
	}

	public function material()
	{
		return $this->hasMany('App\MaterialProgressKerjaHarian', 'id_progress');
	}
}

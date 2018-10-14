<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsentifGaji extends Model
{
	protected $table = 'insentif_gaji';

	public $timestamps = false;

	protected $fillable = [
		'id_insentif',
		'id_gaji',
		'jumlah_insentif',
		'jumlah_lembur',
		'rate_insentif',
		'rate_lembur',
		'insentif_diterima',
		'lembur_diterima',
	];

	public function insentifdetail()
	{
		return $this->belongsTo('App\InsentifSopir','id_insentif');
	}
}

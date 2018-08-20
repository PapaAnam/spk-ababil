<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GajiPengeluaran extends Model
{

	protected $table = 'gaji_pengeluaran';

	public $timestamps = false;

	protected $fillable = [
		'jumlah', 'deskripsi', 'id_gaji'
	];

	public function gaji()
	{
		return $this->belongsTo('App\Gaji', 'id_gaji');
	}

}

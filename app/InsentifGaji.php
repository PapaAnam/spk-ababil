<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsentifGaji extends Model
{
    protected $table = 'insentif_gaji';

	public $timestamps = false;

	protected $fillable = [
		'total_qty',
		'total_lembur',
		'id_insentif',
		'id_gaji',
	];
}

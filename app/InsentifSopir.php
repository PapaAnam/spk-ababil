<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsentifSopir extends Model
{
    protected $table = 'insentif_sopir';

	public $timestamps = false;

	protected $fillable = [
		'nama',
		'insentif',
		'lembur',
		'id_karyawan',
	];
}

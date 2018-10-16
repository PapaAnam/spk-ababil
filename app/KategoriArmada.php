<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriArmada extends Model
{

	protected $table = 'kategori_armada';

	public $timestamps = false;

	protected $fillable = [
		'nama',
	];

}

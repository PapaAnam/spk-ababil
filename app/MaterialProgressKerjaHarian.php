<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialProgressKerjaHarian extends Model
{
    public $timestamps = false;
	protected $table = 'material_progress_kerja_harian';
	protected $fillable = [
		'id_progress',
		'qty',
		'tipe'
	];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoLaporan extends Model
{
    protected $table = 'foto_laporan_progress';

	public $timestamps = false;

	protected $fillable = [
		'id_laporan',
		'url',
	];
}

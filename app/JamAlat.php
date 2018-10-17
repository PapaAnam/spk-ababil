<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JamAlat extends Model
{

	protected $table = 'jam_alat';

	public $timestamps = false;

	protected $fillable = [
		'jam_mulai',
		'jam_selesai',
		'pekerjaan',
		'istirahat',
		'tanggal',
		'id_armada',
	];

	public function armada()
	{
		return $this->belongsTo('App\Armada','id_armada');
	}


}

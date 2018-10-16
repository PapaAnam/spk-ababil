<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
	
	protected $table = 'armada';

	public $timestamps = false;

	protected $fillable = [
		'nama',
	];

}

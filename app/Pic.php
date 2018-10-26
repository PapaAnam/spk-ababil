<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
	public $timestamps = false;
	protected $table = 'pic_detail';
	protected $fillable = [
		'tipe','nama','no_hp','klien',
		'jabatan',
	];

	public function pic()
	{
		return $this->hasMany('App\Pic', 'klien');
	}
}

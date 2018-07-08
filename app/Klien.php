<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
	public $timestamps = false;
	protected $table = 'klien';
	protected $fillable = ['nama_perusahaan','alamat',
	];

	public function pic()
	{
		return $this->hasMany('App\Pic', 'klien');
	}
}

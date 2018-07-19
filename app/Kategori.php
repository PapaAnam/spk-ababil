<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $timestamps = false;
	protected $table = 'kategori_pengeluaran';
	protected $fillable = [
		'nama',
		'id_kategori',
	];

	public function sub()
	{
		return $this->hasMany('App\Kategori', 'id_kategori');
	}
}

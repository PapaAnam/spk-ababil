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

	public function scopeSelectMode($q)
	{
		$data = [];
		foreach ($q->whereNull('id_kategori')->get() as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>'['.$a->id.'] '.$a->nama,
			]);
		}
		return $data;
	}
}

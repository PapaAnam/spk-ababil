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

	public function scopeSelectMode($q)
	{
		$data = [];
		foreach ($q->get() as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>'['.$a->id.'] '.$a->nama,
			]);
		}
		return $data;
	}

}

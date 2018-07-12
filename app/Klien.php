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

	public function scopeSelectMode($q)
	{
		$data = [];
		foreach ($q->get() as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>'['.$a->id.'] '.$a->nama_perusahaan
			]);
		}
		return $data;
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
	public $timestamps = false;
	protected $table = 'rekening';
	protected $fillable = ['bank', 'atas_nama', 'no_rek', 'kantor_cabang',];

	public function scopeSelectMode($q)
	{
		$data = [];
		foreach ($q->get() as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>'['.$a->no_rek.'] '.$a->bank
			]);
		}
		return $data;
	}
}

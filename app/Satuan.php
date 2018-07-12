<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    
   	public $timestamps = false;
   	protected $table = 'satuan';
   	protected $fillable = ['nama'];

   	public function scopeSelectMode($q)
	{
		$data = [];
		foreach ($q->get() as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>$a->nama
			]);
		}
		return $data;
	}

}

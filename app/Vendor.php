<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
	public $timestamps = false;
	protected $table = 'vendor';
	protected $fillable = ['nama','telp','alamat','keterangan','no_rekening'];

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

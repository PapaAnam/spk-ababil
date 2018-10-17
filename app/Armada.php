<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
	
	protected $table = 'armada';

	public $timestamps = false;

	protected $fillable = [
		'nama_unit',
		'plat_no',
		'merk',
		// 'model',
		// 'seri',
		// 'tahun',
		// 'warna',
		'km_per_jam',
		'id_vendor',
		'id_kategori',
		'mulai',
		'selesai',
	];

	public function kategori()
	{
		return $this->belongsTo('App\KategoriArmada','id_kategori');
	}

	public function vendor()
	{
		return $this->belongsTo('App\Vendor','id_vendor');
	}

	public function scopeSelectMode($q)
	{
		$data = [];
		foreach ($q->get() as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>'['.$a->id.'] '.$a->nama_unit
			]);
		}
		return $data;
	}

}

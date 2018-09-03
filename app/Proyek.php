<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mytrait\Tanggal;

class Proyek extends Model
{

use Tanggal;

	public $timestamps = false;
	protected $table = 'proyek';
	protected $fillable = [
		'nama',
		'klien',
		'deskripsi',
		'qty',
		'satuan',
		'start_date',
		'end_date',
	];

	protected $appends = [
		'start_date_indo',
		'end_date_indo',
	];

	public function tugas()
	{
		return $this->hasMany('App\Tugas', 'id_proyek');
	}

	public function pelaksana()
	{
		return $this->hasMany('App\PelaksanaDetail', 'id_proyek');
	}

	public function kliendetail()
	{
		return $this->belongsTo('App\Klien', 'klien');
	}

	public function satuandetail()
	{
		return $this->belongsTo('App\Satuan','satuan');
	}

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

	public function getStartDateIndoAttribute()
	{
		return $this->tglIndo($this->start_date);
	}

	public function getEndDateIndoAttribute()
	{
		return $this->tglIndo($this->end_date);
	}
}

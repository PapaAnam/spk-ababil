<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{

	public $timestamps = false;
	protected $table = 'karyawan';
	protected $fillable = [
		'nama','nik','alamat','no_hp','no_darurat','jabatan','armada','gaji_pokok','rate_per_jam','um_harian','rate_lembur','insentif','jenis',
		'no_rek',
		'atas_nama',
	];

	protected $appends = [
		'gaji_pokok_rp',
		'rate_per_jam_rp',
		'um_harian_rp',
		'rate_lembur_rp',
		'insentif_rp',
	];

	public function scopeSelectMode($q)
	{
		$data = [];
		foreach ($q->get() as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>'['.$a->nik.'] '.$a->nama
			]);
		}
		return $data;
	}

	public function getGajiPokokRpAttribute()
	{
		return number_format($this->gaji_pokok, 0, ',', '.');
	}

	public function getRatePerJamRpAttribute()
	{
		return number_format($this->rate_per_jam, 0, ',', '.');
	}

	public function getUmHarianRpAttribute()
	{
		return number_format($this->um_harian, 0, ',', '.');
	}

	public function getRateLemburRpAttribute()
	{
		return number_format($this->rate_lembur, 0, ',', '.');
	}

	public function getInsentifRpAttribute()
	{
		return number_format($this->insentif, 0, ',', '.');
	}

	public function overtime()
	{
		return $this->hasMany('App\OtOperator','id_karyawan');
	}

	public function insentifdetail()
	{
		return $this->hasMany('App\InsentifSopir','id_karyawan');
	}
}

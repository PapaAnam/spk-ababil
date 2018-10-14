<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{

	protected $table = 'gaji';

	public $timestamps = false;

	protected $fillable = [
		'tanggal_dari', 
		'tanggal_sampai', 
		'id_karyawan', 
		'plat_no', 
		'total_jam_kerja', 
		'gaji_pokok', 
		'rate_per_jam', 
		'um_harian', 
		'jumlah_hari_timesheet', 
		'rate_insentif', 
		'jumlah_insentif', 
		'rate_lembur', 
		'jumlah_lembur', 
		'tanggal', 
		'jabatan', 
		'armada', 
		'jenis',
		'total_gaji',
	];

	protected $appends = [
		'total_gaji', 'total_jam', 'total_uang_makan', 'total_lembur', 'total_insentif', 'total_gaji_rp'
	];

	public function pengeluaran()
	{
		return $this->hasMany('App\GajiPengeluaran', 'id_gaji');
	}

	public function karyawan()
	{
		return $this->belongsTo('App\Karyawan', 'id_karyawan');
	}

	public function getTotalJamAttribute()
	{
		return $this->total_jam_kerja * $this->rate_per_jam;
	}

	public function getTotalUangMakanAttribute()
	{
		return $this->jumlah_hari_timesheet * $this->um_harian;
	}	

	public function getTotalInsentifAttribute()
	{
		return $this->jumlah_insentif * $this->rate_insentif;
	}

	public function getTotalLemburAttribute()
	{
		return $this->jumlah_lembur * $this->rate_lembur;
	}

	// public function getTotalGajiAttribute()
	// {
	// 	$totalPengeluaran = 0;
	// 	foreach ($this->pengeluaran as $p) {
	// 		$totalPengeluaran += $p->jumlah;
	// 	}
	// 	if($this->jenis == 'Sopir'){
	// 		return $this->gaji_pokok + $this->total_uang_makan + $this->total_insentif + $this->total_lembur - $totalPengeluaran;
	// 	}else if($this->jenis == 'Operator'){
	// 		return $this->gaji_pokok + $this->total_jam + $this->total_uang_makan + $this->total_lembur - $totalPengeluaran;
	// 	}
	// 	return $this->gaji_pokok + $this->total_uang_makan + $this->total_lembur - $totalPengeluaran;
	// }

	public function getTotalGajiRpAttribute()
	{
		return number_format($this->total_gaji, 0, ',', '.');
	}

	public function insentif()
	{
		return $this->hasMany('App\InsentifGaji','id_gaji');
	}


	public function overtime()
	{
		return $this->hasMany('App\OvertimeGaji','id_gaji');
	}
}
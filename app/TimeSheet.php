<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
	public $timestamps = false;
	protected $table = 'time_sheet';
	protected $fillable = [
		'tanggal',
		'id_karyawan',
		'jam_mulai',
		'jam_selesai',
		'ritase',
	];
	protected $appends = ['total_jam'];


	public function karyawan()
	{
		return $this->belongsTo('App\Karyawan', 'id_karyawan');
	}

	public function getTotalJamAttribute()
	{
		$total_waktu_dalam_detik = strtotime($this->tanggal.' '.$this->jam_selesai) - strtotime($this->tanggal.' '.$this->jam_mulai);
		if($total_waktu_dalam_detik < 0){
			$total_waktu_dalam_detik = 0;
		}
		return round($total_waktu_dalam_detik/3600, 2);
	}
}

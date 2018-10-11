<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mytrait\Tanggal;

class TimeSheet extends Model
{

	use Tanggal;

	public $timestamps = false;
	protected $table = 'time_sheet';
	protected $fillable = [
		'tanggal',
		'id_karyawan',
		'jam_mulai',
		'jam_selesai',
		'ritase',
		'lembur',
		'istirahat',
	];
	
	protected $appends = [
		'total_jam', 'tanggal_indo'
	];


	public function karyawan()
	{
		return $this->belongsTo('App\Karyawan', 'id_karyawan');
	}

	public function insentif()
	{
		return $this->hasMany('App\InsentifTS','id_timesheet');
	}

	public function overtime()
	{
		return $this->hasMany('App\OvertimeTS','id_timesheet');
	}	

	public function getTotalJamAttribute()
	{
		$total_waktu_dalam_detik = strtotime($this->tanggal.' '.$this->jam_selesai) - strtotime($this->tanggal.' '.$this->jam_mulai);
		if($total_waktu_dalam_detik < 0){
			$total_waktu_dalam_detik = 0;
		}
		return round( ( $total_waktu_dalam_detik / 3600 ) - $this->istirahat , 2 );
	}

	public function getTanggalIndoAttribute()
	{
		return $this->tglIndo($this->tanggal);
	}
}

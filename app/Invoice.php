<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mytrait\Tanggal;

class Invoice extends Model
{

use Tanggal;

	public $timestamps = false;
	protected $table = 'invoice';
	protected $fillable = [
		'tanggal',
		'no_invoice',
		'id_klien',
		'id_proyek',
		'deskripsi',
		'total_tagihan',
		'terbayar',
		'tertagih',
		'id_rekening',
		'id_user',
		'jumlah_tagihan',
	];

	protected $appends = [
		'tanggal_indo'
	];

	public function pajak()
	{
		return $this->hasMany('App\PajakInvoice', 'id_invoice');
	}

	public function ttd()
	{
		return $this->belongsTo('App\User', 'id_user');
	}

	public function rekening()
	{
		return $this->belongsTo('App\Rekening', 'id_rekening');
	}

	public function proyek()
	{
		return $this->belongsTo('App\Proyek', 'id_proyek');
	}

	public function getTanggalIndoAttribute()
	{
		return $this->tglIndo($this->tanggal);
	}
}

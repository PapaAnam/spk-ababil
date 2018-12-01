<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mytrait\TanggalIndo;

class Pengeluaran extends Model
{

	use TanggalIndo;

	public $timestamps = false;
	protected $table = 'pengeluaran';
	protected $fillable = [
		'id_vendor',
		'id_karyawan',
		'nominal',
		'id_proyek',
		'id_kategori',
		'id_sub_kategori',
		'deskripsi',
		'ref',
		'kwitansi',
		'no',
		'tanggal',
		'deskripsi',
		'metode_pembayaran',
		'user_id',
	];

	protected $appends = [
		'tanggal_indo',
	];

	public function pelaksana()
	{
		return $this->belongsTo('App\Karyawan', 'id_karyawan');
	}

	public function proyek()
	{
		return $this->belongsTo('App\Proyek', 'id_proyek');
	}

	public function vendor()
	{
		return $this->belongsTo('App\Vendor', 'id_vendor');
	}

	public function kategori()
	{
		return $this->belongsTo('App\Kategori', 'id_kategori');
	}

	public function subkategori()
	{
		return $this->belongsTo('App\Kategori', 'id_sub_kategori');
	}
}

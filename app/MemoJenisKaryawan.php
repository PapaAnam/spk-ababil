<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemoJenisKaryawan extends Model
{

	protected $table = 'memo_jenis_karyawan';

	protected $fillable = [
		'id_memo',
		'jenis_karyawan'
	];

	public $timestamps = false;

}

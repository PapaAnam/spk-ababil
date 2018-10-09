<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtOperator extends Model
{

	protected $table = 'overtime_operator';

	public $timestamps = false;

	protected $fillable = [
		'nama',
		'rate_overtime',
		'id_karyawan',
	];

}

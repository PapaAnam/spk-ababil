<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OvertimeGaji extends Model
{
    protected $table = 'overtime_gaji';

	public $timestamps = false;

	protected $fillable = [
		'id_overtime',
		'id_gaji',
		'rate_overtime',
		'jumlah_overtime',
		'overtime_diterima',
	];

	public function overtimedetail()
	{
		return $this->belongsTo('App\OtOperator','id_overtime');
	}
}

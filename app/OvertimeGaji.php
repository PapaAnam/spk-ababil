<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OvertimeGaji extends Model
{
    protected $table = 'overtime_gaji';

	public $timestamps = false;

	protected $fillable = [
		'total_qty',
		'id_overtime',
		'id_gaji',
	];
}

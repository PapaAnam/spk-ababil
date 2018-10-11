<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OvertimeTS extends Model
{
    protected $table = 'overtime_timesheet';

	public $timestamps = false;

	protected $fillable = [
		'qty',
		'id_overtime',
		'id_timesheet',
	];
}

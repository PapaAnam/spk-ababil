<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsentifTS extends Model
{
    protected $table = 'insentif_timesheet';

	public $timestamps = false;

	protected $fillable = [
		'qty',
		'qty_lembur',
		'id_insentif',
		'id_timesheet',
	];

	public function timesheetasli()
	{
		return $this->belongsTo('App\TimeSheet','id_timesheet');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PajakInvoice extends Model
{
	public $timestamps = false;
	protected $table = 'pajak_invoice';
	protected $fillable = [
		'id_invoice',
		'nama',
		'pajak',
		'nilai_pajak',
	];

	public function invoice()
	{
		return $this->belongsTo('App\Invoice', 'id_invoice');
	}
}

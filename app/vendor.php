<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
	public $timestamps = false;
	protected $table = 'vendor';
	protected $fillable = ['nama','telp','alamat','keterangan',];
}

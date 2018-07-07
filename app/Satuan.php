<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    
   	public $timestamps = false;
   	protected $table = 'satuan';
   	protected $fillable = ['nama'];

}

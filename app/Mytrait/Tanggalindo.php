<?php 

namespace App\Mytrait;
use App\Mytrait\Tanggal;

trait Tanggalindo {

	use Tanggal;

	public function getTanggalIndoAttribute()
	{
		return $this->tglIndo($this->tanggal);
	}

}
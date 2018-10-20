<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	public $timestamps = false;
	protected $table = 'role';
	protected $fillable = [
		'nama',
		'hak_akses',
	];

	protected $appends = [
		'menu',
	];

	public function scopeSelectMode($q, $where = [])
	{
		$data = [];
		$dd = $q->get();
		if(count($where) > 0){
			$dd = $q->where($where[0], $where[1])->get();
		}
		foreach ($dd as $a) {
			$data[] = collect([
				'value'=>$a->id,
				'text'=>$a->nama,
			]);
		}
		return $data;
	}

	public function getMenuAttribute()
	{
		return json_decode($this->hak_akses);
	}

}

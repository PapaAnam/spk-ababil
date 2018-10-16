<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Klien;
use App\Proyek;
use App\ProgressKerjaHarian;
use DB;

class ProgressController extends Controller
{

	private function dataTugas($proyek, $klien, $idTugas = null, $groupBy = true)
	{
		$data = DB::table('progress_kerja_harian');
		if(!$groupBy){
			$data = $data->select('*',DB::raw('progress_kerja_harian.qty as progress, proyek.nama as nama_proyek, tugas.qty as qty_tugas, satuan.nama as nama_satuan, tugas.id as id_tugas, proyek.id as id_proyek'))
			->orderBy('tanggal','asc');
		}else{
			$data = $data->select('*',DB::raw('SUM(progress_kerja_harian.qty) as progress, proyek.nama as nama_proyek, tugas.qty as qty_tugas, satuan.nama as nama_satuan, tugas.id as id_tugas, proyek.id as id_proyek'));
		}
		$data = $data->join('proyek', 'proyek.id', '=', 'progress_kerja_harian.id_proyek')
		->join('tugas', 'tugas.id', '=', 'progress_kerja_harian.id_tugas')
		->join('satuan', 'satuan.id', '=', 'tugas.satuan')
		->join('klien', 'klien.id', '=', 'proyek.klien');
		if(!is_null($proyek)){
			$data = $data->where('progress_kerja_harian.id_proyek',$proyek);
		}elseif(!is_null($klien)){
			$data = $data->where('proyek.klien',$klien);
		}
		if(!is_null($idTugas)){
			$data = $data->where('id_tugas',$idTugas);
		}
		if($groupBy){
			$data = $data->groupBy('progress_kerja_harian.id_tugas');
		}
		$data = $data->get()
		->transform(function($item,$key){
			$item->progress = (int) $item->progress;
			$item->persentase = round($item->progress / $item->qty_tugas * 100, 2);
			return $item;
		});
		return $data;
	}

	public function tugas(Request $r)
	{
		$klien = $r->query('klien');
		$proyek = $r->query('proyek');
		$data = [];
		if($proyek){
			$data = $this->dataTugas($proyek,null);
		}elseif($klien){
			$data = $this->dataTugas(null,$klien);
		}
		return view('progress.tugas',[
			'listKlien'=>Klien::selectMode(),
			'listProyek'=>Proyek::selectMode(),
			'title'=>'Progress Tugas',
			'data'=>$data,
			'active'=>'progress.tugas',
			'createLink'=>false,
		]);
	}

	public function tugasDetail($idTugas, $idProyek)
	{
		$data = $this->dataTugas($idProyek,null, $idTugas);
		return view('progress.chart-tugas',[
			'listKlien'=>Klien::selectMode(),
			'listProyek'=>Proyek::selectMode(),
			'title'=>'Detail Progress Tugas',
			'data'=>$data,
			'active'=>'progress.tugas',
			'createLink'=>false,
			'charts'=>$this->dataTugas($idProyek,null, $idTugas, false)
		]);
	}

	public function proyek(Request $r)
	{
		$klien = $r->query('klien');
		$data = [];
		if($klien){
			$data = Proyek::with('kliendetail')
			->withCount('tugas')
			->where('klien', $klien)
			->get();
			$data->transform(function($d){
				$hasil = $this->dataTugas($d->id,$d->klien);
				$jml = $hasil->count();
				if($jml <= 0){
					$d->persentase = 0;
				}else{
					$d->persentase = $hasil->sum('persentase') / $jml;
				}
				return $d;
			});
		}
		return view('progress.proyek',[
			'listKlien'=>Klien::selectMode(),
			'title'=>'Progress Proyek',
			'data'=>$data,
			'active'=>'progress.proyek',
			'createLink'=>false,
		]);
	}

	public function proyekDetail($idProyek)
	{
		$data = Proyek::with('kliendetail','pelaksana.karyawan')
		->withCount('tugas')
		->where('id', $idProyek)
		->get()->transform(function($d){
			$hasil = $this->dataTugas($d->id,$d->klien);
			$jml = $hasil->count();
			if($jml <= 0){
				$d->persentase = 0;
			}else{
				$d->persentase = $hasil->sum('persentase') / $jml;
			}
			return $d;
		});
		return view('progress.proyek-detail',[
			'listKlien'=>Klien::selectMode(),
			'title'=>'Detail Progress Proyek',
			'd'=>$data[0],
			'active'=>'progress.proyek',
			'createLink'=>false,
			'modul_link'=>url()->previous(),
			'modul'=>'Progress Tugas',
			'action'=>false,
			'saveBtn'=>false,
		]);
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Klien;
use App\TimeSheet;
use App\Proyek;
use App\Tugas;
use App\ProgressKerjaHarian;
use App\Kategori;
use App\User;

class DasborController extends Controller
{

	public function index()
	{
		// return view('my-dasbor');
		return view('my-dasbor', [
			'title'     => 'Dasbor',
			'active'    => 'dasbor',
			'jmlKar'=>Karyawan::count(),
			'jmlKlien'=>Klien::count(),
			'jmlTS'=>TimeSheet::count(),
			'jmlProyek'=>Proyek::count(),
			'jmlTugas'=>Tugas::count(),
			'jmlProg'=>ProgressKerjaHarian::count(),
			'jmlKat'=>Kategori::count(),
			'jmlUser'=>User::count(),
			'createLink'=>false,
		]);
	}

}

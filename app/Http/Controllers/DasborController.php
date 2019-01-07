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
use App\Invoice;
use App\Pengeluaran;
use App\Memo;

class DasborController extends Controller
{

	public function index()
	{
		$memos = Memo::with('pelaksana.karyawan','jeniskaryawan')->orderBy('tanggal','desc')->get();
		// return $memos;
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
			'jmlInvoice'=>Invoice::count(),
			'jmlPengeluaran'=>Pengeluaran::count(),
			'createLink'=>false,
			'memos'=>$memos,
		]);
	}

	public function jmlTS()
	{
		return TimeSheet::count();
	}

	public function home()
	{
		return redirect('/');
	}

}

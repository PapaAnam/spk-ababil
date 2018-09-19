<?php

namespace App\Http\Controllers;

use App\Gaji;
use Illuminate\Http\Request;
use App\Karyawan;
use DB;
use App\TimeSheet;
use App\Mytrait\Tanggal;

class GajiController extends Controller
{

    use Tanggal;

    public function __construct()
    {
        $this->middleware('myrole:superadmin')->except('create','store','cek');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gaji.all',[
            'title'=>'Laporan Gaji',
            'active'=>'gaji.index',
            'createLink'=>route('gaji.create')
        ]);
    }

    public function byKaryawan(Request $r)
    {
        $data = [];
        $karyawan = $r->query('karyawan');
        $data = Gaji::with('karyawan','pengeluaran')
        ->where('id_karyawan', $karyawan)
        ->get();
        return view('gaji.by-karyawan',[
            'listKaryawan'=>Karyawan::selectMode(),
            'active'=>'gaji.by-karyawan',
            'data'=>$data,
            'title'=>'Laporan Gaji By Karyawan',
            'createLink'=>route('gaji.create')
        ]);
    }

    public function byPeriode(Request $r)
    {
        $data = [];
        $tanggal_dari = $this->englishFormat($r->query('tanggal_dari'));
        $tanggal_sampai = $this->englishFormat($r->query('tanggal_sampai'));
        if($tanggal_dari && $tanggal_sampai){
            $data = Gaji::with('karyawan','pengeluaran')
            ->whereBetween('tanggal_dari', [$tanggal_dari, $tanggal_sampai])
            ->whereBetween('tanggal_sampai', [$tanggal_dari, $tanggal_sampai])
            ->get();
        }
        return view('gaji.by-periode',[
            'active'=>'gaji.by-periode',
            'data'=>$data,
            'title'=>'Laporan Gaji By Periode',
            'createLink'=>route('gaji.create')
        ]);
    }

    public function byJabatan(Request $r)
    {
        $data = [];
        $jabatan = $r->query('jabatan');
        if($jabatan){
            $data = Gaji::with('karyawan','pengeluaran')
            ->where('jabatan', $jabatan)
            ->get();
        }
        return view('gaji.by-jabatan',[
            'active'=>'gaji.by-jabatan',
            'data'=>$data,
            'title'=>'Laporan Gaji By Jabatan',
            'createLink'=>route('gaji.create'),
            'listJabatan'=>$this->getListJabatan(),
        ]);
    }

    private function getListJabatan()
    {
        $data = [];
        foreach(Karyawan::all()->unique('jabatan')->values() as $kar){
            $data[] = [
                'text'=>$kar->jabatan,
                'value'=>$kar->jabatan
            ];
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gaji.tambah', [
            'title'         => 'Hitung Gaji',
            'modul_link'    => route('gaji.index'),
            'modul'         => 'Gaji',
            'action'        => route('gaji.store'),
            'active'        => 'gaji.create',
            'listKaryawan'=>Karyawan::selectMode(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_dari'=>'required|date_format:Y-m-d',
            'tanggal_sampai'=>'required|date_format:Y-m-d',
            'id_karyawan'=>'required|numeric',
            'plat_no'=>'required',
            'total_jam_kerja'=>'required|numeric',
            'gaji_pokok'=>'required|numeric',
            'rate_per_jam'=>'required|numeric',
            'um_harian'=>'required|numeric',
            'jumlah_hari_timesheet'=>'required|numeric',
            'rate_insentif'=>'required|numeric',
            'jumlah_insentif'=>'required|numeric',
            'rate_lembur'=>'required|numeric',
            'jumlah_lembur'=>'required|numeric',
            'jabatan'=>'required',
            'armada'=>'required',
            'total_gaji'=>'required|numeric'
        ]);

        $gaji = Gaji::create([
            'tanggal_sampai'=>$this->englishFormat($request->tanggal_sampai),
            'tanggal_dari'=>$this->englishFormat($request->tanggal_dari),
        ]+$request->except('tanggal_dari','tanggal_sampai'));
        $i = 0;
        foreach ($request->pengeluaran as $p) {
            if($p != null){
                $gaji->pengeluaran()->create([
                    'jumlah'=>$p,
                    'deskripsi'=>$request->deskripsi[$i]
                ]);
            }
            $i++;
        }
        $route = 'gaji.index';
        if($request->user()->role != 'superadmin'){
            $route = 'gaji.create';
        }
        return redirect()->route($route)->with('success_msg', 'Hitung gaji berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function show(Gaji $gaji)
    {
        return view('gaji.detail', [
            'active'=>'gaji.index',
            'modul'=>'Gaji',
            'saveBtn'=>false,
            'd'=>$gaji,
            'title'=>'Detail Gaji',
            'modul_link'=>route('gaji.index'),
            'action'=>false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaji $gaji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaji $gaji)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaji $gaji)
    {
        //
    }

    public function cek(Request $r)
    {
        $karyawan = $r->query('karyawan');
        $tanggal_dari = $r->query('tanggal_dari');
        $tanggal_sampai = $r->query('tanggal_sampai');
        $k = Karyawan::find($karyawan);
        // DB::enableQueryLog();
        $jumlahHariTimeSheet = floor((strtotime($tanggal_sampai) - strtotime($tanggal_dari)) / 3600 / 24);
        $timeSheet = TimeSheet::where('id_karyawan', $karyawan)->whereBetween('tanggal', [
            $tanggal_dari, $tanggal_sampai
        ])->get();
        $totalJamKerja  = $timeSheet->sum('total_jam');
        $jumlahInsentif = $timeSheet->sum('ritase');
        $jumlahLembur   = $timeSheet->sum('lembur');
        if($k->jenis != 'Sopir'){
            $jumlahLembur = ($totalJamKerja - 200) > 0 ? $totalJamKerja - 200 : 0;
        }
        // return DB::getQueryLog();
        return view('gaji.cek',[
            'k'=>$k,
            'totalJamKerja'=>$totalJamKerja,
            'jumlahHariTimeSheet'=>$jumlahHariTimeSheet+1,
            'jumlahInsentif'=>$jumlahInsentif,
            'jumlahLembur'=>$jumlahLembur,
        ]);
    }
}

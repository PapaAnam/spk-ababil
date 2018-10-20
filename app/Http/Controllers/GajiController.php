<?php

namespace App\Http\Controllers;

use App\Gaji;
use Illuminate\Http\Request;
use App\Karyawan;
use DB;
use App\TimeSheet;
use App\Mytrait\Tanggal;
use App\InsentifSopir;
use App\InsentifGaji;
use App\OtOperator;
use App\OvertimeGaji;

class GajiController extends Controller
{

    use Tanggal;

    public function __construct()
    {
        // $this->middleware('myrole:superadmin')->except('create','store','cek');
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
            'tanggal_dari'=>'required|date_format:d-m-Y',
            'tanggal_sampai'=>'required|date_format:d-m-Y',
            'id_karyawan'=>'required|numeric',
            'plat_no'=>'required',
            'total_jam_kerja'=>'required|numeric',
            'gaji_pokok'=>'required|numeric',
            // 'rate_per_jam'=>'required|numeric',
            'um_harian'=>'required|numeric',
            'jumlah_hari_timesheet'=>'required|numeric',
            // 'rate_insentif'=>'required|numeric',
            // 'jumlah_insentif'=>'required|numeric',
            // 'rate_lembur'=>'required|numeric',
            // 'jumlah_lembur'=>'required|numeric',
            'jabatan'=>'required',
            'armada'=>'required',
            'total_gaji'=>'required|numeric'
        ]);
        $data = [
            'tanggal_sampai'=>$this->englishFormat($request->tanggal_sampai),
            'tanggal_dari'=>$this->englishFormat($request->tanggal_dari),
            'id_karyawan'=>$request->id_karyawan,
            'plat_no'=>$request->plat_no,
            'total_jam_kerja'=>$request->total_jam_kerja,
            'gaji_pokok'=>$request->gaji_pokok,
            'rate_per_jam'=>$request->jenis == 'Sopir' ? 0 : $request->rate_per_jam,
            'um_harian'=>$request->um_harian,
            'jumlah_hari_timesheet'=>$request->jumlah_hari_timesheet,
            // 'rate_lembur'=>$request->rate_lembur,
            // 'jumlah_lembur'=>$request->jumlah_lembur,
            'jabatan'=>$request->jabatan,
            'armada'=>$request->armada,
            'jenis'=>$request->jenis,
            'total_gaji'=>$request->total_gaji,
        ];
        // dd($data);
        $gaji = Gaji::create($data);
        $i = 0;
        foreach ($request->pengeluaran as $p) {
            if($p != null){
                $gaji->pengeluaran()->create([
                    'jumlah'=>$p,
                    'deskripsi'=>$request->deskripsi[$i],
                ]);
            }
            $i++;
        }
        $i=0;
        if($request->jenis == 'Sopir'){
            foreach ($request->id_insentif as $id) {
                InsentifGaji::create([
                    'id_insentif'=>$id,
                    'id_gaji'=>$gaji->id,
                    'jumlah_insentif'=>$request->jumlah_insentif[$i],
                    'jumlah_lembur'=>$request->jumlah_lembur[$i],
                    'rate_insentif'=>$request->rate_insentif[$i],
                    'rate_lembur'=>$request->rate_lembur[$i],
                    'insentif_diterima'=>$request->insentif_diterima[$i],
                    'lembur_diterima'=>$request->lembur_diterima[$i++],
                ]);
            }
        }elseif($request->jenis == 'Operator'){
            foreach ($request->id_overtime as $id) {
                OvertimeGaji::create([
                    'id_overtime'=>$id,
                    'id_gaji'=>$gaji->id,
                    'rate_overtime'=>$request->rate_overtime[$i],
                    'jumlah_overtime'=>$request->jumlah_overtime[$i],
                    'overtime_diterima'=>$request->overtime_diterima[$i++],
                ]);
            }
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
    public function show($id)
    {
        $gaji = Gaji::with('overtime.overtimedetail','insentif.insentifdetail')->where('id',$id)->first();
        if(is_null($gaji))
            abort(404);
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
        $gaji->delete();
        return redirect()->back()->with('success_msg','Gaji berhasil dihapus');
    }

    public function cek(Request $r)
    {
        $karyawan = $r->query('karyawan');
        $tanggal_dari = $this->englishFormat($r->query('tanggal_dari'));
        $tanggal_sampai = $this->englishFormat($r->query('tanggal_sampai'));
        $k = Karyawan::find($karyawan);
        $timeSheet = TimeSheet::where('id_karyawan', $karyawan)->whereBetween('tanggal', [
            $tanggal_dari, $tanggal_sampai
        ])->get();
        $jumlahHariTimeSheet = count($timeSheet);
        $totalJamKerja  = $timeSheet->sum('total_jam');
        $jumlahInsentif = $timeSheet->sum('ritase');
        $jumlahLembur   = $timeSheet->sum('lembur');
        if($k->jenis != 'Sopir'){
            $jumlahLembur = ($totalJamKerja - 200) > 0 ? $totalJamKerja - 200 : 0;
        }
        if($k->jenis == 'Sopir'){
            $insentifSopir = InsentifSopir::where('id_karyawan',$k->id)->get();
            $insentifTimesheet = [];
            foreach($insentifSopir as $is){
                $id_insentif = $is->id;
                $hasil = DB::table('time_sheet')
                ->join('insentif_timesheet','time_sheet.id','=','insentif_timesheet.id_timesheet')
                ->where('id_karyawan', $k->id)
                ->whereBetween('tanggal', [
                    $tanggal_dari, $tanggal_sampai
                ])
                ->where('id_insentif',$id_insentif)
                ->get();
                $insentifTimesheet[] = [
                    'id_insentif'=>$is->id,
                    'nama_insentif'=>$is->nama,
                    'rate_insentif'=>$is->insentif,
                    'rate_lembur'=>$is->lembur,
                    'jumlah'=>$hasil->sum('qty'),
                    'jumlah_lembur'=>$hasil->sum('qty_lembur'),
                ];
            }
        }else if ($k->jenis == 'Operator'){
            $overtimeOperator = OtOperator::where('id_karyawan',$k->id)->get();
            $overtimeTimesheet = [];
            foreach($overtimeOperator as $is){
                $id_overtime = $is->id;
                $hasil = DB::table('time_sheet')
                ->join('overtime_timesheet','time_sheet.id','=','overtime_timesheet.id_timesheet')
                ->where('id_karyawan', $k->id)
                ->whereBetween('tanggal', [
                    $tanggal_dari, $tanggal_sampai
                ])
                ->where('id_overtime',$id_overtime)
                ->get();
                $overtimeTimesheet[] = [
                    'id_overtime'=>$is->id,
                    'nama_overtime'=>$is->nama,
                    'rate_overtime'=>$is->rate_overtime,
                    'jumlah_overtime'=>$hasil->sum('qty'),
                ];
            }
        }
        return view('gaji.cek',[
            'k'=>$k,
            'totalJamKerja'=>$totalJamKerja,
            'jumlahHariTimeSheet'=>$jumlahHariTimeSheet,
            'jumlahInsentif'=>$jumlahInsentif,
            'jumlahLembur'=>$jumlahLembur,
            'insentif'=>$k->jenis == 'Sopir' ? $insentifTimesheet : [],
            'overtime'=>$k->jenis == 'Operator' ? $overtimeTimesheet : [],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\TimeSheet;
use App\Karyawan;
use Illuminate\Http\Request;
use DB;
use App\Mytrait\Tanggal;

class TimeSheetController extends Controller
{

    use Tanggal;

    public function __construct()
    {
        $this->middleware('myrole:superadmin')->only('edit','update','destroy');
        $this->middleware('myrole:superadmin,admin')->only('create','store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('time-sheet.tambah', [
            'title'         => 'Tambah Time Sheet',
            'modul_link'    => url()->previous(),
            'modul'         => 'TimeSheet',
            'action'        => route('time-sheet.store'),
            'active'        => 'time-sheet.create',
            'listKaryawan'=>Karyawan::selectMode()
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
            'id_karyawan'=>'required',
            'tanggal'=>'required|date_format:d-m-Y',
            'jam_mulai'=>'required|date_format:H\:i\:s',
            'jam_selesai'=>'required|date_format:H\:i\:s',
            'ritase'=>'required|numeric',
            'lembur'=>'required|numeric',
            'istirahat'=>'required|numeric',
        ]);
        if(TimeSheet::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            TimeSheet::truncate();
        }
        $tanggal = $this->englishFormat($request->tanggal);
        TimeSheet::create([
            'id_karyawan'=>$request->id_karyawan,
            'tanggal'=>$tanggal,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'ritase'=>$request->ritase,
            'lembur'=>$request->lembur,
            'istirahat'=>$request->istirahat,
        ]);
        return redirect()->back()->with('success_msg', 'Time Sheet berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TimeSheet  $timeSheet
     * @return \Illuminate\Http\Response
     */
    public function show(TimeSheet $timeSheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TimeSheet  $timeSheet
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeSheet $timeSheet)
    {
        return view('time-sheet.ubah', [
            'd'             => $timeSheet,
            'title'         => 'Ubah Time Sheet',
            'modul_link'    => url()->previous(),
            'modul'         => 'TimeSheet',
            'action'        => route('time-sheet.update', $timeSheet->id),
            'active'        => 'time-sheet.edit',
            'listKaryawan'=>Karyawan::selectMode(),
            'tanggal'=>$this->formatIndo($timeSheet->tanggal),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeSheet  $timeSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeSheet $timeSheet)
    {
        $request->validate([
            'id_karyawan'=>'required',
            'tanggal'=>'required|date_format:d-m-Y',
            'jam_mulai'=>'required|date_format:H\:i\:s',
            'jam_selesai'=>'required',
            'ritase'=>'required',
            'lembur'=>'required|numeric',
            'istirahat'=>'required|numeric',
        ]);
        $tanggal = $this->englishFormat($request->tanggal);
        $timeSheet->update([
            'id_karyawan'=>$request->id_karyawan,
            'tanggal'=>$tanggal,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'ritase'=>$request->ritase,
            'lembur'=>$request->lembur,
            'istirahat'=>$request->istirahat,
        ]);
        return redirect()->back()->with('success_msg', 'Time Sheet berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeSheet  $timeSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeSheet $timeSheet)
    {
        $timeSheet->delete();
        return redirect()->back()->with('success_msg', 'TimeSheet berhasil dihapus');
    }

    public function byWaktu(Request $r)
    {
        $data = [];
        $dari = $this->englishFormat($r->query('dari'));
        $sampai = $this->englishFormat($r->query('sampai'));
        if($r->query('dari') && $r->query('sampai')){
            $data = TimeSheet::with('karyawan')->whereBetween('tanggal', [
                $dari, $sampai
            ])->get();
        }
        return view('time-sheet.by-waktu', [
            'data'      => $data,
            'title'     => 'Time Sheet By Waktu',
            'active'    => 'time-sheet.by-waktu',
            'createLink'=>route('time-sheet.create'),
            'role'=>[
                'admin','superadmin'
            ]
        ]);
    }

    public function byKaryawan(Request $r)
    {
        $data = [];
        if($r->query('karyawan')){
            $data = TimeSheet::with('karyawan')->where('id_karyawan', $r->query('karyawan'))->get();
        }
        return view('time-sheet.by-karyawan', [
            'data'      => $data,
            'title'     => 'Time Sheet By Karyawan',
            'active'    => 'time-sheet.by-karyawan',
            'createLink'=>route('time-sheet.create'),
            'role'=>[
                'admin','superadmin'
            ],
            'listKaryawan'=>Karyawan::selectMode(),
        ]);
    }
}

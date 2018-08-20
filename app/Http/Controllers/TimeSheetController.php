<?php

namespace App\Http\Controllers;

use App\TimeSheet;
use App\Karyawan;
use Illuminate\Http\Request;
use DB;

class TimeSheetController extends Controller
{

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
        $data = [];
        if($r->query('dari') && $r->query('sampai')){
            $data = TimeSheet::with('karyawan')->whereBetween('tanggal', [
                $r->query('dari'), $r->query('sampai')
            ])->get();
        }
        return view('time-sheet.index', [
            'data'      => $data,
            'title'     => 'Time Sheet',
            'active'    => 'time-sheet.index',
            'createLink'=>route('time-sheet.create'),
            'role'=>[
                'admin','superadmin'
            ]
        ]);
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
            'modul_link'    => route('time-sheet.index'),
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
            'tanggal'=>'required|date_format:Y-m-d',
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
        TimeSheet::create([
            'id_karyawan'=>$request->id_karyawan,
            'tanggal'=>$request->tanggal,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'ritase'=>$request->ritase,
            'lembur'=>$request->lembur,
            'istirahat'=>$request->istirahat,
        ]);
        return redirect()->route('time-sheet.index')->with('success_msg', 'Time Sheet berhasil dibuat');
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
            'modul_link'    => route('time-sheet.index'),
            'modul'         => 'TimeSheet',
            'action'        => route('time-sheet.update', $timeSheet->id),
            'active'        => 'time-sheet.edit',
            'listKaryawan'=>Karyawan::selectMode()
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
            'tanggal'=>'required|date_format:Y-m-d',
            'jam_mulai'=>'required|date_format:H\:i\:s',
            'jam_selesai'=>'required',
            'ritase'=>'required',
            'lembur'=>'required|numeric',
            'istirahat'=>'required|numeric',
        ]);
        $timeSheet->update([
            'id_karyawan'=>$request->id_karyawan,
            'tanggal'=>$request->tanggal,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'ritase'=>$request->ritase,
            'lembur'=>$request->lembur,
            'istirahat'=>$request->istirahat,
        ]);
        return redirect()->route('time-sheet.index')->with('success_msg', 'Time Sheet berhasil diperbarui');
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
        return redirect()->route('time-sheet.index')->with('success_msg', 'TimeSheet berhasil dihapus');
    }
}

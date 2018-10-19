<?php

namespace App\Http\Controllers;

use App\Klien;
use App\Proyek;
use App\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = [];
        $dari = englishFormat($r->query('dari'));
        $sampai = englishFormat($r->query('sampai'));
        if($r->query('dari') && $r->query('sampai')){
            $data = Memo::with('karyawan')->whereBetween('tanggal', [
                $dari, $sampai
            ])->get();
        }elseif($r->query('klien')){
            $data = Memo::with('klien', 'proyek', 'pelaksana.karyawan', 'jeniskaryawan')->where('id_klien', $r->query('klien'))->get();
        }elseif($r->query('proyek')){
            $data = Memo::with('klien', 'proyek', 'pelaksana.karyawan', 'jeniskaryawan')->where('id_proyek', $r->query('proyek'))->get();
        }
        return view('memo.index', [
            'data'      => $data,
            'title'     => 'Memo',
            'active'    => 'memo.index',
            'createLink'=>route('memo.create'),
            'role'=>[
                'admin','superadmin'
            ],
            'listProyek'=>Proyek::selectMode(),
            'listKlien'=>Klien::selectMode(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memo.tambah', [
            'title'         => 'Tambah Memo',
            'modul_link'    => url()->previous(),
            'modul'         => 'Memo',
            'action'        => route('memo.store'),
            'active'        => 'memo.create',
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
        // dd($request->all());
        $request->validate([
            'id_karyawan'=>'required',
            'tanggal'=>'required|date_format:d-m-Y',
            'jam_mulai'=>'required|date_format:H\:i\:s',
            'jam_selesai'=>'required|date_format:H\:i\:s',
            // 'ritase'=>'required|numeric',
            // 'lembur'=>'required|numeric',
            'istirahat'=>'required|numeric',
        ]);
        if(Memo::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Memo::truncate();
        }
        $jenis = Karyawan::find($request->id_karyawan)->jenis;
        $tanggal = englishFormat($request->tanggal);
        $ts = Memo::create([
            'id_karyawan'=>$request->id_karyawan,
            'tanggal'=>$tanggal,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            // 'ritase'=>$request->ritase,
            // 'lembur'=>$request->lembur,
            'istirahat'=>$request->istirahat,
        ]);
        if($jenis == 'Operator'){
            $i = 0;
            foreach ($request->id_overtime as $a) {
                OvertimeTS::create([
                    'qty'=>$request->overtime[$i++] == 'Tidak' ? 0 : 1,
                    'id_overtime'=>$a,
                    'id_timesheet'=>$ts->id,
                ]);
            }
        }elseif($jenis == 'Sopir'){
            $i = 0;
            foreach ($request->id_insentif as $a) {
                if(!is_null($request->insentif[$i]) && !is_null($request->lembur[$i])){
                    InsentifTS::create([
                        'qty'=>$request->insentif[$i],
                        'qty_lembur'=>$request->lembur[$i++],
                        'id_insentif'=>$a,
                        'id_timesheet'=>$ts->id,
                    ]); 
                }
            }
        }
        return redirect()->back()->with('success_msg', 'Memo berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function show(Memo $memo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function edit(Memo $memo)
    {
        return view('memo.ubah', [
            'd'             => $memo,
            'title'         => 'Ubah Memo',
            'modul_link'    => url()->previous(),
            'modul'         => 'Memo',
            'action'        => route('memo.update', $memo->id),
            'active'        => 'memo.edit',
            'listKaryawan'=>Karyawan::selectMode(),
            'tanggal'=>$this->formatIndo($memo->tanggal),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memo $memo)
    {
        // dd($request->all());
        $id_ts = $memo->id;
        $request->validate([
            'id_karyawan'=>'required',
            'tanggal'=>'required|date_format:d-m-Y',
            'jam_mulai'=>'required|date_format:H\:i\:s',
            'jam_selesai'=>'required',
            // 'ritase'=>'required',
            // 'lembur'=>'required|numeric',
            'istirahat'=>'required|numeric',
        ]);
        $jenis = Karyawan::find($request->id_karyawan)->jenis;
        $tanggal = englishFormat($request->tanggal);
        $memo->update([
            'id_karyawan'=>$request->id_karyawan,
            'tanggal'=>$tanggal,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            // 'ritase'=>$request->ritase,
            // 'lembur'=>$request->lembur,
            'istirahat'=>$request->istirahat,
        ]);
        $ts = Memo::find($id_ts);
        if($jenis == 'Operator'){
            $i = 0;
            foreach ($request->id_overtime as $a) {
                OvertimeTS::create([
                    'qty'=>$request->overtime[$i++] == 'Tidak' ? 0 : 1,
                    'id_overtime'=>$a,
                    'id_timesheet'=>$ts->id,
                ]);
            }
        }elseif($jenis == 'Sopir'){
            $i = 0;
            foreach ($request->id_insentif as $a) {
                if(!is_null($request->insentif[$i]) && !is_null($request->lembur[$i])){
                    InsentifTS::updateOrCreate([
                        'id_insentif'=>$a,
                        'id_timesheet'=>$ts->id,
                    ],[
                        'qty'=>$request->insentif[$i],
                        'qty_lembur'=>$request->lembur[$i++],
                    ]); 
                }
            }
        }
        return redirect()->back()->with('success_msg', 'Memo berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memo $memo)
    {
        $memo->delete();
        return redirect()->back()->with('success_msg', 'Memo berhasil dihapus');
    }
}

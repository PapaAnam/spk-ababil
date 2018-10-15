<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;
use DB;
use App\OtOperator;
use App\InsentifSopir;

class KaryawanController extends Controller
{

    public function __construct()
    {
        $this->middleware('myrole:superadmin')->except('index','get');
    }

    private function getListJenis()
    {
        return [
            ['text'=>'--- Pilih Jenis Karyawan ---','value'=>''],
            ['text'=>'Office','value'=>'Office'],
            ['text'=>'Operator','value'=>'Operator'],
            ['text'=>'Sopir','value'=>'Sopir'],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Karyawan::all();
        return view('karyawan.index', [
            'data'      => $data,
            'title'     => 'Karyawan',
            'active'    => 'karyawan.index',
            'createLink'=>route('karyawan.create'),
            'role'=>'superadmin'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.tambah', [
            'title'         => 'Tambah Karyawan',
            'modul_link'    => route('karyawan.index'),
            'modul'         => 'Karyawan',
            'action'        => route('karyawan.store'),
            'active'        => 'karyawan.create',
            'listJenis'=>$this->getListJenis(),
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
            'nama'=>'required',
            'nik'=>'required|numeric',
            'alamat'=>'required',
            'no_hp'=>'required',
            'no_darurat'=>'required',
            'jabatan'=>'required',
            'armada'=>'required',
            'gaji_pokok'=>'required|numeric',
            // 'rate_per_jam'=>'required|numeric',
            'um_harian'=>'required|numeric',
            'rate_lembur'=>$request->jenis == 'Operator' ? 'required|numeric' : "",
            // 'insentif'=>'required|numeric',
            'jenis'=>'required',
            'no_rek'=>'required|numeric',
            'atas_nama'=>'required',
        ]);
        if(Karyawan::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Karyawan::truncate();
        }
        $karyawan = Karyawan::create([
            'nama'=>$request->nama,
            'nik'=>$request->nik,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->no_hp,
            'no_darurat'=>$request->no_darurat,
            'jabatan'=>$request->jabatan,
            'armada'=>$request->armada,
            'gaji_pokok'=>$request->gaji_pokok,
            'rate_per_jam'=>$request->jenis == 'Operator' ? $request->rate_per_jam : 0,
            'um_harian'=>$request->um_harian,
            'rate_lembur'=>$request->jenis == 'Operator' ? $request->rate_lembur : 0,
            // 'insentif'=>$request->insentif,
            'jenis'=>$request->jenis,
            'no_rek'=>$request->no_rek,
            'atas_nama'=>$request->atas_nama,
        ]);
        if($request->jenis == 'Operator'){
            $i=0;
            foreach ($request->nama_overtime as $nama) {
                OtOperator::create([
                    'nama'=>$nama,
                    'rate_overtime'=>$request->rate_overtime[$i++],
                    'id_karyawan'=>$karyawan->id,
                ]);
            }
        }elseif($request->jenis=='Sopir'){
            $i=0;
            foreach ($request->nama_insentif as $nama) {
                InsentifSopir::create([
                    'nama'=>$nama,
                    'insentif'=>$request->insentif[$i],
                    'lembur'=>$request->lembur[$i++],
                    'id_karyawan'=>$karyawan->id,
                ]);
            }
        }
        return redirect()->route('karyawan.index')->with('success_msg', 'Karyawan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        return view('karyawan.detail', [
            'd'=>$karyawan,
            'title'=>'Detail Karyawan',
            'modul_link'=>route('karyawan.index'),
            'modul'=>'Karyawan',
            'action'=>false,
            'active'=>'karyawan.index',
            'saveBtn'=>false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.ubah', [
            'd'             => $karyawan,
            'title'         => 'Ubah Karyawan',
            'modul_link'    => route('karyawan.index'),
            'modul'         => 'Karyawan',
            'action'        => route('karyawan.update', $karyawan->id),
            'active'        => 'karyawan.edit',
            'listJenis'=>$this->getListJenis(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        // dd($request->id_insentif);
        $id_karyawan = $karyawan->id;
        $request->validate([
            'nama'=>'required',
            'nik'=>'required|numeric',
            'alamat'=>'required',
            'no_hp'=>'required',
            'no_darurat'=>'required',
            'jabatan'=>'required',
            'armada'=>'required',
            'gaji_pokok'=>'required|numeric',
            // 'rate_per_jam'=>'required|numeric',
            'um_harian'=>'required|numeric',
            'rate_lembur'=>$request->jenis == 'Operator' ? 'required|numeric' : "",
            // 'insentif'=>'required|numeric',
            'jenis'=>'required',
            'no_rek'=>'required|numeric',
            'atas_nama'=>'required',
            'nama_overtime'=>$request->jenis == 'Operator' ? "required|array" : '',
            'nama_overtime.*'=>$request->jenis == 'Operator' ? "required" : '',
            'nama_insentif'=>$request->jenis == 'Sopir' ? "required|array" : '',
            'nama_insentif.*'=>$request->jenis == 'Sopir' ? "required" : '',
        ]);
        $karyawan->update([
            'nama'=>$request->nama,
            'nik'=>$request->nik,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->no_hp,
            'no_darurat'=>$request->no_darurat,
            'jabatan'=>$request->jabatan,
            'armada'=>$request->armada,
            'gaji_pokok'=>$request->gaji_pokok,
            'rate_per_jam'=>$request->jenis == 'Operator' ? $request->rate_per_jam : 0,
            'um_harian'=>$request->um_harian,
            'rate_lembur'=>$request->jenis == 'Operator' ? $request->rate_lembur : 0,
            // 'insentif'=>$request->insentif,
            'jenis'=>$request->jenis,
            'no_rek'=>$request->no_rek,
            'atas_nama'=>$request->atas_nama,
        ]);
        if($request->jenis == 'Operator'){
            $i=0;
            foreach ($request->nama_overtime as $nama) {
                OtOperator::whereNotIn('id',$request->id_overtime)->where('id_karyawan',$id_karyawan)->delete();
                OtOperator::updateOrCreate([
                    'id'=>$request->id_overtime[$i]
                ],[
                    'nama'=>$nama,
                    'rate_overtime'=>$request->rate_overtime[$i++],
                    'id_karyawan'=>$id_karyawan
                ]);
            }
        }elseif($request->jenis=='Sopir'){
            $i=0;
            foreach ($request->nama_insentif as $nama) {
                InsentifSopir::whereNotIn('id',$request->id_insentif)->where('id_karyawan',$id_karyawan)->delete();
                InsentifSopir::updateOrCreate([
                    'id'=>$request->id_insentif[$i]
                ],[
                    'nama'=>$nama,
                    'insentif'=>$request->insentif[$i],
                    'lembur'=>$request->lembur[$i++],
                    'id_karyawan'=>$id_karyawan
                ]);
            }
        }
        return redirect()->route('karyawan.index')->with('success_msg', 'Karyawan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success_msg', 'Karyawan berhasil dihapus');
    }

    public function get(Request $r)
    {
        return Karyawan::with('overtime','insentifdetail')->where('id', $r->query('id'))->first();
    }
}

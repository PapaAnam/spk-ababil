<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;
use DB;

class KaryawanController extends Controller
{

    public function __construct()
    {
        $this->middleware('myrole:superadmin')->except('index');
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
            'rate_per_jam'=>'required|numeric',
            'um_harian'=>'required|numeric',
            'rate_lembur'=>'required|numeric',
            'insentif'=>'required|numeric',
            'jenis'=>'required',
        ]);
        if(Karyawan::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Karyawan::truncate();
        }
        Karyawan::create([
            'nama'=>$request->nama,
            'nik'=>$request->nik,
            'alamat'=>$request->alamat,
            'no_hp'=>$request->no_hp,
            'no_darurat'=>$request->no_darurat,
            'jabatan'=>$request->jabatan,
            'armada'=>$request->armada,
            'gaji_pokok'=>$request->gaji_pokok,
            'rate_per_jam'=>$request->rate_per_jam,
            'um_harian'=>$request->um_harian,
            'rate_lembur'=>$request->rate_lembur,
            'insentif'=>$request->insentif,
            'jenis'=>$request->jenis,
        ]);
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
        $request->validate([
            'nama'=>'required',
            'nik'=>'required|numeric',
            'alamat'=>'required',
            'no_hp'=>'required',
            'no_darurat'=>'required',
            'jabatan'=>'required',
            'armada'=>'required',
            'gaji_pokok'=>'required|numeric',
            'rate_per_jam'=>'required|numeric',
            'um_harian'=>'required|numeric',
            'rate_lembur'=>'required|numeric',
            'insentif'=>'required|numeric',
            'jenis'=>'required',
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
            'rate_per_jam'=>$request->rate_per_jam,
            'um_harian'=>$request->um_harian,
            'rate_lembur'=>$request->rate_lembur,
            'insentif'=>$request->insentif,
            'jenis'=>$request->jenis,
        ]);
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
}

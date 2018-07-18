<?php

namespace App\Http\Controllers;

use App\Proyek;
use Illuminate\Http\Request;
use App\Karyawan;
use App\Klien;
use App\Satuan;
use App\PelaksanaDetail;
use DB;

class ProyekController extends Controller
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
        $data = Proyek::with('pelaksana.karyawan','kliendetail')->get();
        return view('proyek.index', [
            'data'      => $data,
            'title'     => 'Proyek',
            'active'    => 'proyek.index',
            'createLink'=>route('proyek.create'),
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
        return view('proyek.tambah', [
            'title'         => 'Tambah Proyek',
            'modul_link'    => route('proyek.index'),
            'modul'         => 'Proyek',
            'action'        => route('proyek.store'),
            'active'        => 'proyek.create',
            'listKaryawan'=>Karyawan::selectMode(),
            'listKlien'=>Klien::selectMode(),
            'listSatuan'=>Satuan::selectMode(),
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
            'klien'=>'required',
            'deskripsi'=>'required',
            'qty'=>'required|numeric',
            'satuan'=>'required',
            'pelaksana'=>'array',
            'pelaksana.*'=>'required',
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d',
        ]);
        if(Proyek::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Proyek::truncate();
        }
        $proyek = Proyek::create([
            'nama'=>$request->nama,
            'klien'=>$request->klien,
            'deskripsi'=>$request->deskripsi,
            'qty'=>$request->qty,
            'satuan'=>$request->satuan,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ]);
        foreach ($request->pelaksana as $p) {
            PelaksanaDetail::create([
                'id_pelaksana'=>$p,
                'id_proyek'=>$proyek->id,
            ]);
        }
        return redirect()->route('proyek.index')->with('success_msg', 'Proyek berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function show(Proyek $proyek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyek $proyek)
    {
        return view('proyek.ubah', [
            'd'             => $proyek,
            'title'         => 'Ubah Proyek',
            'modul_link'    => route('proyek.index'),
            'modul'         => 'Proyek',
            'action'        => route('proyek.update', $proyek->id),
            'active'        => 'proyek.edit',
            'pelaksana'=>$proyek->pelaksana()->pluck('id_pelaksana'),
            'listKaryawan'=>Karyawan::selectMode(),
            'listKlien'=>Klien::selectMode(),
            'listSatuan'=>Satuan::selectMode(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyek $proyek)
    {
        $request->validate([
            'nama'=>'required',
            'klien'=>'required',
            'deskripsi'=>'required',
            'qty'=>'required|numeric',
            'satuan'=>'required',
            'pelaksana'=>'array',
            'pelaksana.*'=>'required',
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d',
        ]);
        $proyek->update([
            'nama'=>$request->nama,
            'klien'=>$request->klien,
            'deskripsi'=>$request->deskripsi,
            'qty'=>$request->qty,
            'satuan'=>$request->satuan,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
        ]);
        $proyek->pelaksana()->delete();
        foreach ($request->pelaksana as $p) {
            PelaksanaDetail::create([
                'id_pelaksana'=>$p,
                'id_proyek'=>$proyek->id,
            ]);
        }
        return redirect()->route('proyek.index')->with('success_msg', 'Proyek berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyek $proyek)
    {
        $proyek->pelaksana()->delete();
        $proyek->delete();
        return redirect()->route('proyek.index')->with('success_msg', 'Proyek berhasil dihapus');
    }

    public function get(Request $r)
    {
        return Proyek::where('klien', $r->klien)->get();
    }
}

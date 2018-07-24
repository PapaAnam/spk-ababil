<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;
use App\Kategori;
use App\Vendor;
use App\Karyawan;
use App\Proyek;
use DB;
use Storage;

class PengeluaranController extends Controller
{
	public function __construct()
	{
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
    	$data = [];
        $query = Pengeluaran::with('vendor','proyek','kategori','subkategori','pelaksana');
        if($r->query('dari') && $r->query('sampai')){
            $data = $query
            ->whereBetween('tanggal', [$r->query('dari'), $r->query('sampai')])
            ->get();
        }elseif($r->query('kategori')){
            $data = $query
            ->where('id_kategori', $r->query('kategori'))
            ->get();
        }elseif($r->query('vendor')){
            $data = $query
            ->where('id_vendor', $r->query('vendor'))
            ->get();
        }elseif($r->query('pelaksana')){
            $data = $query
            ->where('id_karyawan', $r->query('pelaksana'))
            ->get();
        }elseif($r->query('proyek')){
            $data = $query
            ->where('id_proyek', $r->query('proyek'))
            ->get();
        }
    	return view('pengeluaran.index', [
    		'data'      => $data,
    		'title'     => 'Pengeluaran',
    		'active'    => 'pengeluaran.index',
    		'createLink'=>route('pengeluaran.create'),
    		'listKategori'=>Kategori::selectMode(),
            'listVendor'=>Vendor::selectMode(),
            'listProyek'=>Proyek::selectMode(),
            'listPelaksana'=>Karyawan::selectMode(),
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('pengeluaran.tambah', [
    		'title'         => 'Tambah Pengeluaran',
    		'modul_link'    => route('pengeluaran.index'),
    		'modul'         => 'Pengeluaran',
    		'action'        => route('pengeluaran.store'),
    		'active'        => 'pengeluaran.index',
    		'listVendor'=>Vendor::selectMode(),
    		'listProyek'=>Proyek::selectMode(),
    		'listPelaksana'=>Karyawan::selectMode(),
    		'listKategori'=>Kategori::selectMode(),
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
    		'id_vendor'=>'required',
    		'id_karyawan'=>'required',
    		'nominal'=>'required|numeric',
    		'id_proyek'=>'required',
    		'id_kategori'=>'required',
    		'ref'=>'required',
    		'kwitansi'=>'required',
            'no'=>'required',
            'tanggal'=>'required',
    	]);
    	if(Pengeluaran::count() == 0){
    		DB::statement('set foreign_key_checks=0;');
    		Pengeluaran::truncate();
    	}
        $kwitansi = $request->kwitansi->store('public/kwitansi');
        $kwitansi = url(str_replace('public/', 'storage/', $kwitansi));
    	$klien = Pengeluaran::create([
    		'id_vendor'=>$request->id_vendor,
            'id_karyawan'=>$request->id_karyawan,
            'nominal'=>$request->nominal,
            'id_proyek'=>$request->id_proyek,
            'id_kategori'=>$request->id_kategori,
            'id_sub_kategori'=>$request->id_sub_kategori,
            'ref'=>$request->ref,
            'kwitansi'=>$kwitansi,
            'no'=>$request->no,
            'tanggal'=>$request->tanggal,
    	]);
    	return redirect()->route('pengeluaran.index')->with('success_msg', 'Pengeluaran berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $klien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $klien)
    {
    	$klien = Pengeluaran::with('pic')->where('id',$klien->id)->first();
    	return view('pengeluaran.ubah', [
    		'd'             => $klien,
    		'title'         => 'Ubah Pengeluaran',
    		'modul_link'    => route('pengeluaran.index'),
    		'modul'         => 'Pengeluaran',
    		'action'        => route('pengeluaran.update', $klien->id),
    		'active'        => 'pengeluaran.edit'
    	]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $klien)
    {
    	$request->validate([
    		'nama_perusahaan'=>'required',
    		'alamat'=>'required',
    		'tipe'=>'required|array',
    		'nama'=>'required|array',
    		'no_hp'=>'required|array',
    		'tipe.*'=>'required',
    		'nama.*'=>'required',
    		'no_hp.*'=>'required',
    	]);
    	$klien->pic()->delete();
    	foreach ($request->tipe as $key => $type) {
    		Pic::create([
    			'tipe' => $request->tipe[$key],
    			'nama' => $request->nama[$key],
    			'no_hp' => $request->no_hp[$key],
    			'klien'=>$klien->id,
    		]);
    	}
    	$klien->update([
    		'nama_perusahaan'=>$request->nama_perusahaan,
    		'alamat'=>$request->alamat,
    	]);
    	return redirect()->route('pengeluaran.index')->with('success_msg', 'Pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $klien)
    {
    	$klien->pic()->delete();
    	$klien->delete();
    	return redirect()->route('pengeluaran.index')->with('success_msg', 'Pengeluaran berhasil dihapus');
    }
  }

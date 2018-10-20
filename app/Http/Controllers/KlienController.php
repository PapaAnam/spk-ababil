<?php

namespace App\Http\Controllers;

use App\Klien;
use App\Pic;
use Illuminate\Http\Request;
use DB;

class KlienController extends Controller
{

    public function __construct()
    {
        // $this->middleware('myrole:superadmin')->except('index','create','store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Klien::with('pic')->get();
        return view('klien.index', [
            'data'      => $data,
            'title'     => 'Klien',
            'active'    => 'klien.index',
            'createLink'=>route('klien.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('klien.tambah', [
            'title'         => 'Tambah Klien',
            'modul_link'    => route('klien.index'),
            'modul'         => 'Klien',
            'action'        => route('klien.store'),
            'active'        => 'klien.create'
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
            'nama_perusahaan'=>'required',
            'alamat'=>'required',
            'tipe'=>'required|array',
            'nama'=>'required|array',
            'no_hp'=>'required|array',
            'tipe.*'=>'required',
            'nama.*'=>'required',
            'no_hp.*'=>'required',
        ]);
        if(Klien::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Klien::truncate();
        }
        $klien = Klien::create([
            'nama_perusahaan'=>$request->nama_perusahaan,
            'alamat'=>$request->alamat,
        ]);
        foreach ($request->tipe as $key => $type) {
            Pic::create([
                'tipe' => $request->tipe[$key],
                'nama' => $request->nama[$key],
                'no_hp' => $request->no_hp[$key],
                'klien'=>$klien->id,
            ]);
        }
        return redirect()->route('klien.index')->with('success_msg', 'Klien berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Klien  $klien
     * @return \Illuminate\Http\Response
     */
    public function show(Klien $klien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Klien  $klien
     * @return \Illuminate\Http\Response
     */
    public function edit(Klien $klien)
    {
        $klien = Klien::with('pic')->where('id',$klien->id)->first();
        return view('klien.ubah', [
            'd'             => $klien,
            'title'         => 'Ubah Klien',
            'modul_link'    => route('klien.index'),
            'modul'         => 'Klien',
            'action'        => route('klien.update', $klien->id),
            'active'        => 'klien.edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Klien  $klien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Klien $klien)
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
        return redirect()->route('klien.index')->with('success_msg', 'Klien berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Klien  $klien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klien $klien)
    {
        $klien->pic()->delete();
        $klien->delete();
        return redirect()->route('klien.index')->with('success_msg', 'Klien berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use App\JamAlat;
use App\Armada;
use Illuminate\Http\Request;

class JamAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JamAlat::with('armada')->get();
        return view('jam-alat.index', [
            'data'      => $data,
            'title'     => 'Armada',
            'active'    => 'jam-alat.index',
            'createLink'=>route('jam-alat.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jam-alat.tambah', [
            'title'         => 'Tambah Jam Alat',
            'modul_link'    => route('jam-alat.index'),
            'modul'         => 'Jam Alat',
            'action'        => route('jam-alat.store'),
            'active'        => 'jam-alat.create',
            'listArmada'=>Armada::selectMode(),
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
            'jam_mulai'=>'required|date_format:H:i:s',
            'jam_selesai'=>'required|date_format:H:i:s',
            'id_armada'=>'required',
        ]);
        if(Armada::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Armada::truncate();
        }
        JamAlat::create([
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'pekerjaan'=>$request->pekerjaan,
            'id_armada'=>$request->id_armada,
        ]);
        return redirect()->route('jam-alat.index')->with('success_msg', 'Jam Alat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JamAlat  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function show(JamAlat $jamAlat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JamAlat  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function edit(JamAlat $jamAlat)
    {
        return view('jam-alat.ubah', [
            'd'             => $jamAlat,
            'title'         => 'Ubah Armada',
            'modul_link'    => route('jam-alat.index'),
            'modul'         => 'Armada',
            'action'        => route('jam-alat.update', $jamAlat->id),
            'active'        => 'jam-alat.edit',
            'listArmada'=>Armada::selectMode(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JamAlat  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JamAlat $jamAlat)
    {
        $request->validate([
            'jam_mulai'=>'required|date_format:H\:i\:s',
            'jam_selesai'=>'required|date_format:H\:i\:s',
            'id_armada'=>'required',
        ]);
        $jamAlat->update([
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'pekerjaan'=>$request->pekerjaan,
            'id_armada'=>$request->id_armada,
        ]);
        return redirect()->route('jam-alat.index')->with('success_msg', 'Jam Alat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JamAlat  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function destroy(JamAlat $jamAlat)
    {
        $jamAlat->delete();
        return redirect()->route('jam-alat.index')->with('success_msg', 'Jam Alat berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use App\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rekening::all();
        return view('rekening.index', [
            'data'      => $data,
            'title'     => 'Rekening',
            'active'    => 'rekening'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rekening.tambah', [
            'title'         => 'Tambah Rekening',
            'modul_link'    => route('rekening'),
            'modul'         => 'Rekening',
            'action'        => route('rekening.store'),
            'active'        => 'rekening.create'
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
            'bank'              => 'required',
            'atas_nama'         => 'required',
            'no_rek'            => 'required|numeric',
            'kantor_cabang'     => 'required',
        ]);
        if(Rekening::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Rekening::truncate();
        }
        Rekening::create([
            'bank'              => $request->bank,
            'atas_nama'         => $request->atas_nama,
            'no_rek'            => $request->no_rek,
            'kantor_cabang'     => $request->kantor_cabang,
        ]);
        return redirect()->route('rekening')->with('success_msg', 'Rekening berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function show(Rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekening $rekening)
    {
        return view('rekening.ubah', [
            'd'             => $rekening,
            'title'         => 'Ubah Rekening',
            'modul_link'    => route('rekening'),
            'modul'         => 'Rekening',
            'action'        => route('rekening.update', $rekening->id),
            'active'        => 'rekening.edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'bank'              => 'required',
            'atas_nama'         => 'required',
            'no_rek'            => 'required|numeric',
            'kantor_cabang'     => 'required',
        ]);
        $rekening->update([
            'bank'              => $request->bank,
            'atas_nama'         => $request->atas_nama,
            'no_rek'            => $request->no_rek,
            'kantor_cabang'     => $request->kantor_cabang,
        ]);
        return redirect()->route('rekening')->with('success_msg', 'Rekening berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        $rekening->delete();
        return redirect()->route('rekening')->with('success_msg', 'Rekening berhasil dihapus');
    }
}

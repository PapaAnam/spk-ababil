<?php

namespace App\Http\Controllers;

use DB;
use App\KategoriArmada;
use Illuminate\Http\Request;

class KategoriArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KategoriArmada::all();
        return view('kategori-armada.index', [
            'data'      => $data,
            'title'     => 'Kategori Armada',
            'active'    => 'kategori-armada.index',
            'createLink'=>route('kategori-armada.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori-armada.tambah', [
            'title'         => 'Tambah Kategori Armada',
            'modul_link'    => route('kategori-armada.index'),
            'modul'         => 'Kategori Armada',
            'action'        => route('kategori-armada.store'),
            'active'        => 'kategori-armada.create'
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
            'nama'  => 'required'
        ]);
        if(KategoriArmada::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            KategoriArmada::truncate();
        }
        KategoriArmada::create([
            'nama' => $request->nama
        ]);
        return redirect()->route('kategori-armada.index')->with('success_msg', 'Kategori Armada berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KategoriArmada  $kategoriArmada
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriArmada $kategoriArmada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KategoriArmada  $kategoriArmada
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriArmada $kategoriArmada)
    {
        return view('kategori-armada.ubah', [
            'd'             => $kategoriArmada,
            'title'         => 'Ubah Kategori Armada',
            'modul_link'    => route('kategori-armada.index'),
            'modul'         => 'Kategori Armada',
            'action'        => route('kategori-armada.update', $kategoriArmada->id),
            'active'        => 'kategori-armada.edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KategoriArmada  $kategoriArmada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriArmada $kategoriArmada)
    {
        $request->validate([
            'nama'  => 'required'
        ]);
        $kategoriArmada->update([
            'nama' => $request->nama
        ]);
        return redirect()->route('kategori-armada.index')->with('success_msg', 'Kategori Armada berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KategoriArmada  $kategoriArmada
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriArmada $kategoriArmada)
    {
        $kategoriArmada->delete();
        return redirect()->route('kategori-armada.index')->with('success_msg', 'Kategori Armada berhasil dihapus');
    }
}

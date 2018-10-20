<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use DB;

class KategoriController extends Controller
{
    public function __construct()
    {
        // $this->middleware('myrole:superadmin')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::with('sub')->whereNull('id_kategori')->get();
        return view('kategori.index', [
            'data'      => $data,
            'title'     => 'Kategori Pengeluaran',
            'active'    => 'kategori.index',
            'createLink'=>route('kategori.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.tambah', [
            'title'         => 'Tambah Kategori Pengeluaran',
            'modul_link'    => route('kategori.index'),
            'modul'         => 'Kategori',
            'action'        => route('kategori.store'),
            'active'        => 'kategori.create'
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
        ]);
        if(Kategori::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Kategori::truncate();
        }
        $kategori = Kategori::create([
            'nama'=>$request->nama,
        ]);
        return redirect()->route('kategori.index')->with('success_msg', 'Kategori Pengeluaran berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.ubah', [
            'd'             => $kategori,
            'title'         => 'Ubah Kategori Pengeluaran',
            'modul_link'    => route('kategori.index'),
            'modul'         => 'Kategori',
            'action'        => route('kategori.update', $kategori->id),
            'active'        => 'kategori.index'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama'=>'required',
        ]);
        $kategori->update([
            'nama'=>$request->nama,
        ]);
        return redirect()->route('kategori.index')->with('success_msg', 'Kategori Pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::where('id_kategori', $kategori->id)->delete();
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success_msg', 'Kategori Pengeluaran berhasil dihapus');
    }
}

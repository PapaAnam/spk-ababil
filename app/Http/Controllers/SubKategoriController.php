<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class SubKategoriController extends Controller
{

	public function __construct()
    {
        $this->middleware('myrole:superadmin');
    }
    
    public function create(Kategori $kategori)
    {
        return view('sub-kategori.tambah', [
            'title'         => 'Tambah Sub Kategori Pengeluaran',
            'modul_link'    => route('kategori.index'),
            'modul'         => 'Kategori',
            'action'        => route('sub-kategori.store',[$kategori->id]),
            'active'        => 'kategori.index',
            'd'=>$kategori,
        ]);
    }

    public function store(Kategori $kategori, Request $request)
    {
        $request->validate([
            'nama'=>'required',
        ]);
        $klien = Kategori::create([
            'nama'=>$request->nama,
            'id_kategori'=>$kategori->id,
        ]);
        return redirect()->route('kategori.index')->with('success_msg', 'Sub Kategori Pengeluaran berhasil dibuat');
    }

    public function edit(Kategori $kategori, Kategori $subKategori)
    {
        return view('sub-kategori.ubah', [
        	'kategori'=>$kategori,
            'd'             => $subKategori,
            'title'         => 'Ubah Sub Kategori Pengeluaran',
            'modul_link'    => route('kategori.index'),
            'modul'         => 'Kategori',
            'action'        => route('sub-kategori.update', [$kategori->id, $subKategori->id]),
            'active'        => 'kategori.index'
        ]);
    }

    public function update(Request $request, Kategori $kategori, Kategori $subKategori)
    {
        $request->validate([
            'nama'=>'required',
        ]);
        $subKategori->update([
            'nama'=>$request->nama,
        ]);
        return redirect()->route('kategori.index')->with('success_msg', 'Sub Kategori Pengeluaran berhasil diperbarui');
    }

    public function destroy(Kategori $kategori, Kategori $subKategori)
    {
        $subKategori->delete();
        return redirect()->route('kategori.index')->with('success_msg', 'Sub Kategori Pengeluaran berhasil dihapus');
    }

}

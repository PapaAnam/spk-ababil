<?php

namespace App\Http\Controllers;

use App\Satuan;
use DB;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data = Satuan::all();
        return view('satuan.index', [
        	'data'		=> $data,
        	'title'		=> 'Satuan',
        	'active'	=> 'satuan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('satuan.tambah', [
        	'title'			=> 'Tambah Satuan',
        	'modul_link'	=> route('satuan'),
        	'modul'			=> 'Satuan',
        	'action'		=> route('satuan.store'),
        	'active'		=> 'satuan.create'
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
        	'nama'	=> 'required'
        ]);
        if(Satuan::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Satuan::truncate();
        }
        Satuan::create([
        	'nama' => $request->nama
        ]);
        return redirect()->route('satuan')->with('success_msg', 'Satuan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        return view('satuan.ubah', [
        	'd'				=> $satuan,
        	'title'			=> 'Ubah Satuan',
        	'modul_link'	=> route('satuan'),
        	'modul'			=> 'Satuan',
        	'action'		=> route('satuan.update', $satuan->id),
        	'active'		=> 'satuan.edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
        	'nama'	=> 'required'
        ]);
        $satuan->update([
        	'nama' => $request->nama
        ]);
        return redirect()->route('satuan')->with('success_msg', 'Satuan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->delete();
        return redirect()->route('satuan')->with('success_msg', 'Satuan berhasil dihapus');
    }
}

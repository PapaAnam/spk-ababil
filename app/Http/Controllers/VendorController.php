<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use DB;

class VendorController extends Controller
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
        $data = Vendor::all();
        return view('vendor.index', [
            'data'      => $data,
            'title'     => 'Vendor',
            'active'    => 'vendor.index',
            'createLink'=>route('vendor.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.tambah', [
            'title'         => 'Tambah Vendor',
            'modul_link'    => route('vendor.index'),
            'modul'         => 'Vendor',
            'action'        => route('vendor.store'),
            'active'        => 'vendor.create'
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
            'nama'              => 'required',
            'telp'         => 'required',
            'alamat'            => 'required',
            'keterangan'     => 'required',
            'no_rekening'     => 'required',
        ]);
        if(Vendor::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Vendor::truncate();
        }
        Vendor::create([
            'nama'              => $request->nama,
            'telp'         => $request->telp,
            'alamat'            => $request->alamat,
            'keterangan'     => $request->keterangan,
            'no_rekening'=>$request->no_rekening,
        ]);
        return redirect()->route('vendor.index')->with('success_msg', 'Vendor berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendor.ubah', [
            'd'             => $vendor,
            'title'         => 'Ubah Vendor',
            'modul_link'    => route('vendor.index'),
            'modul'         => 'Vendor',
            'action'        => route('vendor.update', $vendor->id),
            'active'        => 'vendor.edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'nama'              => 'required',
            'telp'         => 'required',
            'alamat'            => 'required',
            'keterangan'     => 'required',
            'no_rekening'     => 'required',
        ]);
        $vendor->update([
            'nama'              => $request->nama,
            'telp'         => $request->telp,
            'alamat'            => $request->alamat,
            'keterangan'     => $request->keterangan,
            'no_rekening'=>$request->no_rekening,
        ]);
        return redirect()->route('vendor.index')->with('success_msg', 'Vendor berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')->with('success_msg', 'Vendor berhasil dihapus');
    }
}

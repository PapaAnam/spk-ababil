<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('vendor.index', [
            'data'      => $data,
            'title'     => 'User',
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
            'title'         => 'Tambah User',
            'modul_link'    => route('vendor.index'),
            'modul'         => 'User',
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
        ]);
        if(User::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            User::truncate();
        }
        User::create([
            'nama'              => $request->nama,
            'telp'         => $request->telp,
            'alamat'            => $request->alamat,
            'keterangan'     => $request->keterangan,
        ]);
        return redirect()->route('vendor.index')->with('success_msg', 'User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $uam
     * @return \Illuminate\Http\Response
     */
    public function show(User $uam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $uam
     * @return \Illuminate\Http\Response
     */
    public function edit(User $uam)
    {
        return view('vendor.ubah', [
            'd'             => $uam,
            'title'         => 'Ubah User',
            'modul_link'    => route('vendor.index'),
            'modul'         => 'User',
            'action'        => route('vendor.update', $uam->id),
            'active'        => 'vendor.edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $uam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $uam)
    {
        $request->validate([
            'nama'              => 'required',
            'telp'         => 'required',
            'alamat'            => 'required',
            'keterangan'     => 'required',
        ]);
        $uam->update([
            'nama'              => $request->nama,
            'telp'         => $request->telp,
            'alamat'            => $request->alamat,
            'keterangan'     => $request->keterangan,
        ]);
        return redirect()->route('vendor.index')->with('success_msg', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $uam
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $uam)
    {
        $uam->delete();
        return redirect()->route('vendor.index')->with('success_msg', 'User berhasil dihapus');
    }
}

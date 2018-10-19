<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use DB;

class RoleMakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::all();
        return view('role-maker.index', [
            'data'      => $data,
            'title'     => 'Role Maker',
            'active'    => 'role-maker.index',
            'createLink'=>route('role-maker.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role-maker.tambah', [
            'title'         => 'Tambah Role Maker',
            'modul_link'    => route('role-maker.index'),
            'modul'         => 'Role Maker',
            'action'        => route('role-maker.store'),
            'active'        => 'role-maker.index'
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
        if(Role::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Role::truncate();
        }
        Role::create([
            'nama' => $request->nama,
            'hak_akses'=>json_encode($request->except('_method','_token','submit','nama','check_all')),
        ]);
        return redirect()->route('role-maker.index')->with('success_msg', 'Role Maker berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $roleMaker
     * @return \Illuminate\Http\Response
     */
    public function show(Role $roleMaker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $roleMaker
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $roleMaker)
    {
        return view('role-maker.ubah', [
            'd'             => $roleMaker,
            'title'         => 'Ubah Role Maker',
            'modul_link'    => route('role-maker.index'),
            'modul'         => 'Role Maker',
            'action'        => route('role-maker.update', $roleMaker->id),
            'active'        => 'role-maker.index'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $roleMaker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $roleMaker)
    {
        $request->validate([
            'nama'  => 'required'
        ]);
        $roleMaker->update([
            'nama' => $request->nama,
            'hak_akses'=>json_encode($request->except('_method','_token','submit','nama','check_all')),
        ]);
        return redirect()->route('role-maker.index')->with('success_msg', 'Role Maker berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $roleMaker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $roleMaker)
    {
        $roleMaker->delete();
        return redirect()->route('role-maker.index')->with('success_msg', 'Role Maker berhasil dihapus');
    }
}

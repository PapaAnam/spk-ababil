<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;

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
        return view('uam.index', [
            'data'      => $data,
            'title'     => 'User',
            'active'    => 'uam.index',
            'createLink'=>route('uam.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uam.tambah', [
            'title'         => 'Tambah User',
            'modul_link'    => route('uam.index'),
            'modul'         => 'User',
            'action'        => route('uam.store'),
            'active'        => 'uam.create'
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
            'nama_lengkap'              => 'required',
            'jabatan'         => 'required',
            'email'            => 'required|unique:users',
            'password'     => 'required',
            'role'     => 'required',
        ]);
        if(User::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            User::truncate();
        }
        User::create([
            'nama_lengkap'              => $request->nama_lengkap,
            'jabatan'         => $request->jabatan,
            'email'            => $request->email,
            'password'     => $request->password,
            'role'     => $request->role,
        ]);
        return redirect()->route('uam.index')->with('success_msg', 'User berhasil dibuat');
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
        return view('uam.ubah', [
            'd'             => $uam,
            'title'         => 'Ubah User',
            'modul_link'    => route('uam.index'),
            'modul'         => 'User',
            'action'        => route('uam.update', $uam->id),
            'active'        => 'uam.edit'
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
        $rule = [
            'nama_lengkap'              => 'required',
            'jabatan'         => 'required',
            'email'            => 'required|unique:users',
            'password'     => 'nullable',
            'role'     => 'required',
        ];
        if($uam->email == $request->email){
            $rule['email'] = 'required';
        }
        $data = [
            'nama_lengkap'              => $request->nama_lengkap,
            'jabatan'         => $request->jabatan,
            'email'            => $request->email,
            'role'     => $request->role,
        ];
        if($request->password){
            $data['password'] = $request->password;
        }
        $request->validate($rule);
        $uam->update($data);
        return redirect()->route('uam.index')->with('success_msg', 'User berhasil diperbarui');
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
        return redirect()->route('uam.index')->with('success_msg', 'User berhasil dihapus');
    }
}

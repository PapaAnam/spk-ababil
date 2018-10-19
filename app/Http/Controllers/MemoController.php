<?php

namespace App\Http\Controllers;

use App\Klien;
use App\Proyek;
use App\Memo;
use App\MemoPelaksana;
use App\MemoJenisKaryawan;
use App\Karyawan;
use DB;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = [];
        $dari = englishFormat($r->query('dari'));
        $sampai = englishFormat($r->query('sampai'));
        if($r->query('dari') && $r->query('sampai')){
            $data = Memo::with('karyawan')->whereBetween('tanggal', [
                $dari, $sampai
            ])->get();
        }elseif($r->query('klien')){
            $data = Memo::with('klien', 'proyek', 'pelaksana.karyawan', 'jeniskaryawan')->where('id_klien', $r->query('klien'))->get();
        }elseif($r->query('proyek')){
            $data = Memo::with('klien', 'proyek', 'pelaksana.karyawan', 'jeniskaryawan')->where('id_proyek', $r->query('proyek'))->get();
        }
        return view('memo.index', [
            'data'      => $data,
            'title'     => 'Memo',
            'active'    => 'memo.index',
            'createLink'=>route('memo.create'),
            'role'=>[
                'admin','superadmin'
            ],
            'listProyek'=>Proyek::selectMode(),
            'listKlien'=>Klien::selectMode(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memo.tambah', [
            'title'         => 'Tambah Memo',
            'modul_link'    => url()->previous(),
            'modul'         => 'Memo',
            'action'        => route('memo.store'),
            'active'        => 'memo.index',
            'listPelaksana'=>Karyawan::selectMode(),
            'listProyek'=>Proyek::selectMode(),
            'listKlien'=>Klien::selectMode(),
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
            'id_karyawan'=>'required',
            'tanggal'=>'required|date_format:d-m-Y',
            'deadline'=>'required|date_format:d-m-Y',
            'pesan'=>'required|string',
        ]);
        if(Memo::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Memo::truncate();
        }
        $memo = Memo::create([
            'id_klien'=>$request->id_klien,
            'id_proyek'=>$request->id_proyek,
            'tanggal'=>englishFormat($request->tanggal),
            'deadline'=>englishFormat($request->deadline),
            'pesan'=>$request->pesan,
        ]);
        $id_memo = $memo->id;
        if($request->id_karyawan){
            foreach ($request->id_karyawan as $a) {
                MemoPelaksana::create([
                    'id_karyawan'=>$a,
                    'id_memo'=>$id_memo,
                ]);
            }
        }
        if($request->jenis_karyawan){
            foreach ($request->jenis_karyawan as $a) {
                MemoJenisKaryawan::create([
                    'jenis_karyawan'=>$a,
                    'id_memo'=>$id_memo
                ]);
            }
        }
        return redirect()->back()->with('success_msg', 'Memo berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function show(Memo $memo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function edit(Memo $memo)
    {
        return view('memo.ubah', [
            'd'             => $memo,
            'title'         => 'Ubah Memo',
            'modul_link'    => url()->previous(),
            'modul'         => 'Memo',
            'action'        => route('memo.update', $memo->id),
            'active'        => 'memo.edit',
            'listPelaksana'=>Karyawan::selectMode(),
            'listProyek'=>Proyek::selectMode(),
            'listKlien'=>Klien::selectMode(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memo $memo)
    {
        $id_memo = $memo->id;
        $request->validate([
            'id_karyawan'=>'required',
            'tanggal'=>'required|date_format:d-m-Y',
            'deadline'=>'required|date_format:d-m-Y',
            'pesan'=>'required|string',
        ]);
        $memo->update([
            'id_klien'=>$request->id_klien,
            'id_proyek'=>$request->id_proyek,
            'tanggal'=>englishFormat($request->tanggal),
            'deadline'=>englishFormat($request->deadline),
            'pesan'=>$request->pesan,
        ]);
        MemoPelaksana::where('id_memo', $id_memo)->delete();
        MemoJenisKaryawan::where('id_memo', $id_memo)->delete();
        if($request->id_karyawan){
            foreach ($request->id_karyawan as $a) {
                MemoPelaksana::create([
                    'id_karyawan'=>$a,
                    'id_memo'=>$id_memo,
                ]);
            }
        }
        if($request->jenis_karyawan){
            foreach ($request->jenis_karyawan as $a) {
                MemoJenisKaryawan::create([
                    'jenis_karyawan'=>$a,
                    'id_memo'=>$id_memo
                ]);
            }
        }
        return redirect()->back()->with('success_msg', 'Memo berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memo $memo)
    {
        $memo->delete();
        return redirect()->back()->with('success_msg', 'Memo berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\ProgressKerjaHarian;
use Illuminate\Http\Request;
use App\Proyek;
use DB;

class ProgressKerjaHarianController extends Controller
{
    public function __construct()
    {
        $this->middleware('myrole:superadmin,admin')->except('show');
    }

    private function getListCuaca(){
        return [
            ['text'=>'Cerah','value'=>'Cerah'],
            ['text'=>'Berawan','value'=>'Berawan'],
            ['text'=>'H. Gerimis','value'=>'H. Gerimis'],
            ['text'=>'H. Lebat','value'=>'H. Lebat'],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = ProgressKerjaHarian::with(['proyek'=>function($q){
            $q->withCount('tugas');
        }, 'material'=>function($q){
            $q->orderBy('tipe', 'asc');
        }])->get();
        return view('progress-kerja-harian.index', [
            'data'      => $data,
            'title'     => 'Progress Kerja Harian',
            'active'    => 'progress-kerja-harian.index',
            'createLink'=>route('progress-kerja-harian.create'),
            'role'=>[
                'admin','superadmin'
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('progress-kerja-harian.tambah', [
            'title'         => 'Tambah Progress Kerja Harian',
            'modul_link'    => route('progress-kerja-harian.index'),
            'modul'         => 'ProgressKerjaHarian',
            'action'        => route('progress-kerja-harian.store'),
            'active'        => 'progress-kerja-harian.index',
            'listProyek'=>Proyek::selectMode(),
            'listCuaca'=>$this->getListCuaca(),
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
            'id_proyek'=>'required',
            'ritase'=>'required|numeric',
            'cuaca'=>'required',
            'tanggal'=>'required|date_format:Y-m-d',
        ]);
        if(ProgressKerjaHarian::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            ProgressKerjaHarian::truncate();
        }
        $progressKerjaHarian = ProgressKerjaHarian::create([
            'tanggal'=>$request->tanggal,
            'cuaca'=>$request->cuaca,
            'deskripsi'=>$request->deskripsi,
            'ritase'=>$request->ritase,
            'id_proyek'=>$request->id_proyek,
            'kendala'=>$request->kendala
        ]);
        // set material
        $proyek = Proyek::with('tugas')->where('id', $request->id_proyek)->first();
        $progressKerjaHarian->material()->create([
            'qty'=>$proyek->qty,
            'tipe'=>'proyek'
        ]);
        foreach ($proyek->tugas as $tugas) {
            $progressKerjaHarian->material()->create([
                'qty'=>$tugas->qty,
                'tipe'=>'tugas'
            ]);
        }
        return redirect()->route('progress-kerja-harian.index')->with('success_msg', 'Progress Kerja Harian berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProgressKerjaHarian  $progressKerjaHarian
     * @return \Illuminate\Http\Response
     */
    public function show(ProgressKerjaHarian $progressKerjaHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProgressKerjaHarian  $progressKerjaHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgressKerjaHarian $progressKerjaHarian)
    {
        return view('progress-kerja-harian.ubah', [
            'd'             => $progressKerjaHarian,
            'title'         => 'Ubah ProgressKerjaHarian',
            'modul_link'    => route('progress-kerja-harian.index'),
            'modul'         => 'ProgressKerjaHarian',
            'action'        => route('progress-kerja-harian.update', $progressKerjaHarian->id),
            'active'        => 'progress-kerja-harian.edit',
            'listProyek'=>Proyek::selectMode(),
            'listCuaca'=>$this->getListCuaca(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProgressKerjaHarian  $progressKerjaHarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgressKerjaHarian $progressKerjaHarian)
    {
        $request->validate([
            'id_proyek'=>'required',
            'ritase'=>'required|numeric',
            'cuaca'=>'required',
            'tanggal'=>'required|date_format:Y-m-d',
        ]);
        $progressKerjaHarian->update([
            'tanggal'=>$request->tanggal,
            'cuaca'=>$request->cuaca,
            'deskripsi'=>$request->deskripsi,
            'ritase'=>$request->ritase,
            'id_proyek'=>$request->id_proyek,
            'kendala'=>$request->kendala
        ]);
        $progressKerjaHarian->material()->delete();
        // set material
        $proyek = Proyek::with('tugas')->where('id', $request->id_proyek)->first();
        $progressKerjaHarian->material()->create([
            'qty'=>$proyek->qty,
            'tipe'=>'proyek'
        ]);
        foreach ($proyek->tugas as $tugas) {
            $progressKerjaHarian->material()->create([
                'qty'=>$tugas->qty,
                'tipe'=>'tugas'
            ]);
        }
        return redirect()->route('progress-kerja-harian.index')->with('success_msg', 'Progress Kerja Harian berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProgressKerjaHarian  $progressKerjaHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgressKerjaHarian $progressKerjaHarian)
    {
        $progressKerjaHarian->delete();
        return redirect()->route('progress-kerja-harian.index')->with('success_msg', 'Progress Kerja Harian berhasil dihapus');
    }
}

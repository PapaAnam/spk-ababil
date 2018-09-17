<?php

namespace App\Http\Controllers;

use App\Tugas;
use Illuminate\Http\Request;
use App\Karyawan;
use App\Proyek;
use App\Satuan;
use App\PelaksanaTugas;
use DB;
use App\Klien;

class TugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('myrole:superadmin,admin')->only('create','store', 'edit','update','destroy');
    }

    public function index()
    {
        return view('tugas.index',[
            'title'=>'Tugas',
            'active'=>null,
            'createLink'=>false,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function byKlien(Request $r)
    {
        $data = [];
        if($r->query('klien')){
            $data = Tugas::with('pelaksana.karyawan','proyek.kliendetail')
            ->get()
            ->transform(function($item) use ($r){
                if($item->proyek->klien == $r->query('klien')){
                    return $item;
                }
            })->reject(function($item){
                return is_null($item);
            })->values();
        }
        return view('tugas.by-klien', [
            'data'      => $data,
            'title'     => 'Tugas By Klien',
            'active'    => 'tugas.by-klien',
            'createLink'=>route('tugas.create'),
            'role'=>[
                'admin','superadmin'
            ],
            'listKlien'=>Klien::selectMode(),
        ]);
    }

    public function byProyek(Request $r)
    {
        $data = [];
        if($r->query('proyek')){
            $data = Tugas::with('pelaksana.karyawan','proyek.kliendetail')
            ->where('id_proyek', $r->proyek)
            ->get();
        }
        return view('tugas.by-proyek', [
            'data'      => $data,
            'title'     => 'Tugas By Klien',
            'active'    => 'tugas.by-proyek',
            'createLink'=>route('tugas.create'),
            'role'=>[
                'admin','superadmin'
            ],
            'listProyek'=>Proyek::selectMode(),
        ]);
    }

    public function byWaktu(Request $r)
    {
        $data = [];
        if($r->query('dari') && $r->query('sampai')){
            $data = Tugas::with('pelaksana.karyawan','proyek.kliendetail')
            ->where('start_date','>=',$r->query('dari'))
            ->where('end_date','<=',$r->query('sampai'))
            ->get();
        }
        return view('tugas.by-waktu', [
            'data'      => $data,
            'title'     => 'Tugas By Waktu',
            'active'    => 'tugas.by-waktu',
            'createLink'=>route('tugas.create'),
            'role'=>[
                'admin','superadmin'
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tugas.tambah', [
            'title'         => 'Tambah Tugas',
            'modul_link'    => url()->previous(),
            'modul'         => 'Tugas',
            'action'        => route('tugas.store'),
            'active'        => 'tugas.create',
            'listKaryawan'=>Karyawan::selectMode(),
            'listProyek'=>Proyek::selectMode(),
            'listSatuan'=>Satuan::selectMode(),
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
            'nama_tugas'=>'required',
            'id_proyek'=>'required',
            'deskripsi'=>'required',
            'material'=>'required',
            'qty'=>'required|numeric',
            'satuan'=>'required',
            'pelaksana'=>'required|array',
            'pelaksana.*'=>'required',
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d',
        ]);
        if(Tugas::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Tugas::truncate();
        }
        $tugas = Tugas::create([
            'id_proyek'=>$request->id_proyek,
            'deskripsi'=>$request->deskripsi,
            'qty'=>$request->qty,
            'satuan'=>$request->satuan,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'material'=>$request->material,
            'nama_tugas'=>$request->nama_tugas,
        ]);
        foreach ($request->pelaksana as $p) {
            PelaksanaTugas::create([
                'id_pelaksana'=>$p,
                'id_tugas'=>$tugas->id,
            ]);
        }
        return redirect()->back()->with('success_msg', 'Tugas berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tugas  $tuga
     * @return \Illuminate\Http\Response
     */
    public function show(Tugas $tuga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tugas  $tuga
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugas $tuga)
    {
        return view('tugas.ubah', [
            'd'             => $tuga,
            'title'         => 'Ubah Tugas',
            'modul_link'    => route('tugas.index'),
            'modul'         => 'Tugas',
            'action'        => route('tugas.update', $tuga->id),
            'active'        => 'tugas.edit',
            'pelaksana'=>$tuga->pelaksana()->pluck('id_pelaksana'),
            'listKaryawan'=>Karyawan::selectMode(),
            'listProyek'=>Proyek::selectMode(),
            'listSatuan'=>Satuan::selectMode(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tugas  $tuga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugas $tuga)
    {
        // dd($request->all());
        $request->validate([
            'nama_tugas'=>'required',
            'id_proyek'=>'required',
            'deskripsi'=>'required',
            'qty'=>'required|numeric',
            'satuan'=>'required',
            'pelaksana'=>'required|array',
            'pelaksana.*'=>'required',
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d',
        ]);
        $tuga->update([
            'id_proyek'=>$request->id_proyek,
            'deskripsi'=>$request->deskripsi,
            'qty'=>$request->qty,
            'satuan'=>$request->satuan,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'nama_tugas'=>$request->nama_tugas,
        ]);
        $tuga->pelaksana()->delete();
        foreach ($request->pelaksana as $p) {
            PelaksanaTugas::create([
                'id_pelaksana'=>$p,
                'id_tugas'=>$tuga->id,
            ]);
        }
        return redirect()->back()->with('success_msg', 'Tugas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tugas  $tuga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tuga)
    {
        $tuga->pelaksana()->delete();
        $tuga->delete();
        return redirect()->back()->with('success_msg', 'Tugas berhasil dihapus');
    }

    public function select(Request $r)
    {
        $tugas = Tugas::where('id_proyek', $r->proyek)->get();
        $options = '';
        if(count($tugas) > 0){
            foreach ($tugas as $t) {
                $options .= '<option value="'.$t->id.'">ID Tugas '.$t->id.'</option>';
            }   
        }else{
            $options .= '<option value="">Tidak ada tugas di proyek ini</option>';
        }
        return $options;
    }

    public function detail(Request $r)
    {
        return Tugas::find($r->query('id'));
    }

}

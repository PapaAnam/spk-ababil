<?php

namespace App\Http\Controllers;

use App\ProgressKerjaHarian;
use App\Tugas;
use Illuminate\Http\Request;
use App\Proyek;
use DB;
use App\Mytrait\Tanggal;
use App\FotoLaporan;

class ProgressKerjaHarianController extends Controller
{

    use Tanggal;

    public function __construct()
    {
        // $this->middleware('myrole:superadmin,admin')->except('show');
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
        // dd(1);
        $data = ProgressKerjaHarian::with(['proyek','tugas.satuandetail'])->get();
        return view('progress-kerja-harian.index', [
            'data'      => $data,
            'title'     => 'Progress Kerja Harian',
            'active'    => 'progress-kerja-harian.index',
            'createLink'=>route('progress-kerja-harian.create'),
            // 'role'=>[
            //     'admin','superadmin'
            // ]
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
            'modul'         => 'Progress Kerja Harian',
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
            'tanggal'=>'required|date_format:d-m-Y',
            'qty2'=>'required|numeric|min:0',
        ]);
        if(ProgressKerjaHarian::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            ProgressKerjaHarian::truncate();
        }
        $progressKerjaHarian = ProgressKerjaHarian::create([
            'tanggal'=>$this->englishFormat($request->tanggal),
            'cuaca'=>$request->cuaca,
            'deskripsi'=>$request->deskripsi,
            'ritase'=>$request->ritase,
            'id_proyek'=>$request->id_proyek,
            'id_tugas'=>$request->id_tugas,
            'kendala'=>$request->kendala,
            'qty'=>$request->qty2
        ]);
        if($request->file('attach')){
            foreach ($request->file('attach') as $attach) {
                $progressKerjaHarian->foto()->create([
                    'url'=>uploadPath($attach,'progress-kerja-harian')
                ]);
            }   
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
        $progressKerjaHarian->load('foto','tugas','proyek');
        return view('progress-kerja-harian.detail', [
            'd'             => $progressKerjaHarian,
            'title'         => 'Detail Progress Kerja Harian',
            'modul_link'    => route('progress-kerja-harian.index'),
            'modul'         => 'Progress Kerja Harian',
            'active'        => 'progress-kerja-harian.index',
            'action'=>false,
            'simpanBtn'=>false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProgressKerjaHarian  $progressKerjaHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgressKerjaHarian $progressKerjaHarian)
    {
        $progressKerjaHarian->load('foto','tugas','proyek');
        return view('progress-kerja-harian.ubah', [
            'd'             => $progressKerjaHarian,
            'title'         => 'Ubah Progress Kerja Harian',
            'modul_link'    => route('progress-kerja-harian.index'),
            'modul'         => 'Progress Kerja Harian',
            'action'        => route('progress-kerja-harian.update', $progressKerjaHarian->id),
            'active'        => 'progress-kerja-harian.edit',
            'listProyek'=>Proyek::selectMode(),
            'listCuaca'=>$this->getListCuaca(),
            'listTugas'=>$this->getListTugas($progressKerjaHarian->id_proyek),
            'tanggal'=>$this->formatIndo($progressKerjaHarian->tanggal),
        ]);
    }

    private function getListTugas($idProyek)
    {
        $tugas = Tugas::where('id_proyek', $idProyek)->get();
        $data = [];
        foreach ($tugas as $t) {
            $data[] = ['text'=>'ID Tugas '.$t->id,'value'=>$t->id];
        }
        return $data;
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
            'tanggal'=>'required|date_format:d-m-Y',
        ]);
        $progressKerjaHarian->update([
            'tanggal'=>$this->englishFormat($request->tanggal),
            'cuaca'=>$request->cuaca,
            'deskripsi'=>$request->deskripsi,
            'ritase'=>$request->ritase,
            'id_proyek'=>$request->id_proyek,
            'id_tugas'=>$request->id_tugas,
            'kendala'=>$request->kendala,
            'qty'=>$request->qty2
        ]);
        if($request->file('attach')){
            foreach ($request->file('attach') as $attach) {
                $progressKerjaHarian->foto()->create([
                    'url'=>uploadPath($attach,'progress-kerja-harian')
                ]);
            }
        }
        FotoLaporan::destroy($request->siap_dihapus);
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

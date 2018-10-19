<?php

namespace App\Http\Controllers;

use App\KonsumsiBBM;
use Illuminate\Http\Request;
use DB;
use App\Armada;
use App\Proyek;
use App\Vendor;
use App\Karyawan;

class KonsumsiBBMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = [];
        if($r->query('dari') && $r->query('sampai')){
            $data = KonsumsiBBM::with('vendor','pelaksana','armada','proyek')
            ->whereBetween('tanggal_masuk',[englishFormat($r->query('dari')),englishFormat($r->query('sampai')),])
            ->orWhere(function($q) use ($r){
                $q->whereBetween('tanggal_keluar',[englishFormat($r->query('dari')),englishFormat($r->query('sampai')),]);
            })
            ->get();
        }
        return view('konsumsi-bbm.index', [
            'data'      => $data,
            'title'     => 'Konsumsi BBM',
            'active'    => 'konsumsi-bbm.index',
            'createLink'=>false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konsumsi-bbm.tambah', [
            'title'         => 'Tambah Konsumsi BBM',
            'modul_link'    => route('konsumsi-bbm.index'),
            'modul'         => 'Konsumsi BBM',
            'action'        => route('konsumsi-bbm.store'),
            'active'        => 'konsumsi-bbm.create',
            'listArmada'=>Armada::selectMode(),
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
            'jam_mulai'=>'required|date_format:H:i:s',
            'jam_selesai'=>'required|date_format:H:i:s',
            'id_armada'=>'required',
        ]);
        if(Armada::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Armada::truncate();
        }
        KonsumsiBBM::create([
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'pekerjaan'=>$request->pekerjaan,
            'id_armada'=>$request->id_armada,
        ]);
        return redirect()->route('konsumsi-bbm.index')->with('success_msg', 'Konsumsi BBM berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KonsumsiBBM  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function show(KonsumsiBBM $jamAlat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KonsumsiBBM  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function edit(KonsumsiBBM $jamAlat)
    {
        return view('konsumsi-bbm.ubah', [
            'd'             => $jamAlat,
            'title'         => 'Ubah Armada',
            'modul_link'    => route('konsumsi-bbm.index'),
            'modul'         => 'Armada',
            'action'        => route('konsumsi-bbm.update', $jamAlat->id),
            'active'        => 'konsumsi-bbm.edit',
            'listArmada'=>Armada::selectMode(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KonsumsiBBM  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KonsumsiBBM $jamAlat)
    {
        $request->validate([
            'jam_mulai'=>'required|date_format:H\:i\:s',
            'jam_selesai'=>'required|date_format:H\:i\:s',
            'id_armada'=>'required',
        ]);
        $jamAlat->update([
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'pekerjaan'=>$request->pekerjaan,
            'id_armada'=>$request->id_armada,
        ]);
        return redirect()->route('konsumsi-bbm.index')->with('success_msg', 'Konsumsi BBM berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KonsumsiBBM  $jamAlat
     * @return \Illuminate\Http\Response
     */
    public function destroy(KonsumsiBBM $konsumsiBbm)
    {
        $konsumsiBbm->delete();
        return redirect()->route('konsumsi-bbm.index')->with('success_msg', 'Konsumsi BBM berhasil dihapus');
    }

    public function masuk()
    {
        return view('konsumsi-bbm.masuk', [
            'title'         => 'BBM Masuk',
            'modul_link'    => route('konsumsi-bbm.index'),
            'modul'         => 'Konsumsi BBM',
            'action'        => route('konsumsi-bbm.masuk-store'),
            'active'        => 'konsumsi-bbm.index',
            'listVendor'=>Vendor::selectMode(),
        ]);
    }

    public function masukStore(Request $request)
    {
        $request->validate([
            'tanggal_masuk'=>'required|date_format:d-m-Y',
            'qty_masuk'=>'required|numeric',
        ]);
        if(KonsumsiBBM::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            KonsumsiBBM::truncate();
        }
        KonsumsiBBM::create([
            'tanggal_masuk'=>englishFormat($request->tanggal_masuk),
            'qty_masuk'=>$request->qty_masuk,
            'keterangan_masuk'=>$request->keterangan_masuk,
            'id_vendor'=>$request->id_vendor,
        ]);
        return redirect()->route('konsumsi-bbm.index')->with('success_msg', 'BBM Masuk berhasil dibuat');
    }

    public function editMasuk(KonsumsiBBM $masuk)
    {
        return view('konsumsi-bbm.edit-masuk', [
            'title'         => 'BBM Masuk',
            'modul_link'    => route('konsumsi-bbm.index'),
            'modul'         => 'Konsumsi BBM',
            'action'        => route('konsumsi-bbm.masuk-update',[$masuk->id]),
            'active'        => 'konsumsi-bbm.index',
            'listVendor'=>Vendor::selectMode(),
            'd'=>$masuk,
        ]);
    }

    public function masukUpdate(Request $request, KonsumsiBBM $masuk)
    {
        $request->validate([
            'tanggal_masuk'=>'required|date_format:d-m-Y',
            'qty_masuk'=>'required|numeric',
        ]);
        if(KonsumsiBBM::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            KonsumsiBBM::truncate();
        }
        $masuk->update([
            'tanggal_masuk'=>englishFormat($request->tanggal_masuk),
            'qty_masuk'=>$request->qty_masuk,
            'keterangan_masuk'=>$request->keterangan_masuk,
            'id_vendor'=>$request->id_vendor,
        ]);
        return redirect()->route('konsumsi-bbm.index')->with('success_msg', 'BBM Masuk berhasil dibuat');
    }

    public function keluar()
    {
        return view('konsumsi-bbm.keluar', [
            'title'         => 'BBM Keluar',
            'modul_link'    => route('konsumsi-bbm.index'),
            'modul'         => 'Konsumsi BBM',
            'action'        => route('konsumsi-bbm.keluar-store'),
            'active'        => 'konsumsi-bbm.index',
            'listPelaksana'=>Karyawan::selectMode(),
            'listArmada'=>Armada::selectMode(),
            'listProyek'=>Proyek::selectMode(),
        ]);
    }

    public function keluarStore(Request $request)
    {
        $request->validate([
            'tanggal_keluar'=>'required|date_format:d-m-Y',
            'qty_keluar'=>'required|numeric',
        ]);
        if(KonsumsiBBM::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            KonsumsiBBM::truncate();
        }
        KonsumsiBBM::create([
            'tanggal_keluar'=>englishFormat($request->tanggal_keluar),
            'qty_keluar'=>$request->qty_keluar,
            'keterangan_keluar'=>$request->keterangan_keluar,
            'id_proyek'=>$request->id_proyek,
            'id_armada'=>$request->id_armada,
            'id_karyawan'=>$request->id_karyawan,
        ]);
        return redirect()->route('konsumsi-bbm.index')->with('success_msg', 'BBM Keluar berhasil dibuat');
    }

    public function editKeluar(KonsumsiBBM $keluar)
    {
        return view('konsumsi-bbm.edit-keluar', [
            'title'         => 'BBM Keluar',
            'modul_link'    => route('konsumsi-bbm.index'),
            'modul'         => 'Konsumsi BBM',
            'action'        => route('konsumsi-bbm.keluar-update',[$keluar->id]),
            'active'        => 'konsumsi-bbm.index',
            'listPelaksana'=>Karyawan::selectMode(),
            'listArmada'=>Armada::selectMode(),
            'listProyek'=>Proyek::selectMode(),
            'd'=>$keluar,
        ]);
    }

    public function keluarUpdate(Request $request, KonsumsiBBM $keluar)
    {
        $request->validate([
            'tanggal_keluar'=>'required|date_format:d-m-Y',
            'qty_keluar'=>'required|numeric',
        ]);
        if(KonsumsiBBM::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            KonsumsiBBM::truncate();
        }
        $keluar->update([
            'tanggal_keluar'=>englishFormat($request->tanggal_keluar),
            'qty_keluar'=>$request->qty_keluar,
            'keterangan_keluar'=>$request->keterangan_keluar,
            'id_proyek'=>$request->id_proyek,
            'id_armada'=>$request->id_armada,
            'id_karyawan'=>$request->id_karyawan,
        ]);
        return redirect()->route('konsumsi-bbm.index')->with('success_msg', 'BBM Keluar berhasil dibuat');
    }
}

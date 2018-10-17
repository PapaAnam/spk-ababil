<?php

namespace App\Http\Controllers;

use App\Armada;
use Illuminate\Http\Request;
use App\Vendor;
use App\KategoriArmada;
use DB;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Armada::with('kategori','vendor')->get();
        return view('armada.index', [
            'data'      => $data,
            'title'     => 'Armada',
            'active'    => 'armada.index',
            'createLink'=>route('armada.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('armada.tambah', [
            'title'         => 'Tambah Armada',
            'modul_link'    => route('armada.index'),
            'modul'         => 'Armada',
            'action'        => route('armada.store'),
            'active'        => 'armada.create',
            'listVendor'=>Vendor::selectMode(),
            'listKategori'=>KategoriArmada::selectMode(),
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
            'nama_unit'=>'required',
            'plat_no'=>'required',
            'merk'=>'required',
            // 'model'=>'required',
            // 'seri'=>'required',
            // 'tahun'=>'required|numeric|max:3000|min:1900',
            // 'warna'=>'required',
            'km_per_jam'=>'required',
            'mulai'=>'required|date_format:d-m-Y',
            'selesai'=>'required|date_format:d-m-Y',
        ]);
        if(Armada::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Armada::truncate();
        }
        $id_vendor=$request->id_vendor;
        $id_kategori=$request->id_kategori;
        if($request->vendor_baru){
            $vendor = Vendor::create([
                'nama'              => $request->vendor_baru,
                'telp'         => '-',
                'alamat'            => '-',
                'keterangan'     => '-',
            ]);
            $id_vendor = $vendor->id;
        }
        if($request->kategori_baru){
            $kategori = KategoriArmada::create([
                'nama'              => $request->kategori_baru,
            ]);
            $id_kategori = $kategori->id;
        }
        Armada::create([
            'nama_unit'=>$request->nama_unit,
            'plat_no'=>$request->plat_no,
            'merk'=>$request->merk,
            // 'model'=>$request->model,
            // 'seri'=>$request->seri,
            // 'tahun'=>$request->tahun,
            // 'warna'=>$request->warna,
            'km_per_jam'=>$request->km_per_jam,
            'id_vendor'=>$id_vendor,
            'id_kategori'=>$id_kategori,
            'mulai'=>englishFormat($request->mulai),
            'selesai'=>englishFormat($request->selesai),
        ]);
        return redirect()->route('armada.index')->with('success_msg', 'Armada berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function show(Armada $armada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function edit(Armada $armada)
    {
        return view('armada.ubah', [
            'd'             => $armada,
            'title'         => 'Ubah Armada',
            'modul_link'    => route('armada.index'),
            'modul'         => 'Armada',
            'action'        => route('armada.update', $armada->id),
            'active'        => 'armada.edit',
            'listVendor'=>Vendor::selectMode(),
            'listKategori'=>KategoriArmada::selectMode(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Armada $armada)
    {
        $request->validate([
            'nama_unit'=>'required',
            'plat_no'=>'required',
            'merk'=>'required',
            // 'model'=>'required',
            // 'seri'=>'required',
            // 'tahun'=>'required|numeric|max:3000|min:1900',
            // 'warna'=>'required',
            'km_per_jam'=>'required',
            'mulai'=>'required|date_format:d-m-Y',
            'selesai'=>'required|date_format:d-m-Y',
        ]);
        $id_vendor=$request->id_vendor;
        $id_kategori=$request->id_kategori;
        if($request->vendor_baru){
            $vendor = Vendor::create([
                'nama'              => $request->vendor_baru,
                'telp'         => '-',
                'alamat'            => '-',
                'keterangan'     => '-',
            ]);
            $id_vendor = $vendor->id;
        }
        if($request->kategori_baru){
            $kategori = KategoriArmada::create([
                'nama'              => $request->kategori_baru,
            ]);
            $id_kategori = $kategori->id;
        }
        $armada->update([
            'nama_unit'=>$request->nama_unit,
            'plat_no'=>$request->plat_no,
            'merk'=>$request->merk,
            // 'model'=>$request->model,
            // 'seri'=>$request->seri,
            // 'tahun'=>$request->tahun,
            // 'warna'=>$request->warna,
            'km_per_jam'=>$request->km_per_jam,
            'id_vendor'=>$id_vendor,
            'id_kategori'=>$id_kategori,
            'mulai'=>englishFormat($request->mulai),
            'selesai'=>englishFormat($request->selesai),
        ]);
        return redirect()->route('armada.index')->with('success_msg', 'Armada berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Armada  $armada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Armada $armada)
    {
        $armada->delete();
        return redirect()->route('armada.index')->with('success_msg', 'Armada berhasil dihapus');
    }
}

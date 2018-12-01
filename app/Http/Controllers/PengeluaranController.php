<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Auth;
use Illuminate\Http\Request;
use App\Kategori;
use App\Vendor;
use App\Karyawan;
use App\Proyek;
use DB;
use Storage;
use App\Mytrait\Tanggal;

class PengeluaranController extends Controller
{

    use Tanggal;

	// public function __construct()
	// {
	// }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
    	$data = [];
    	$query = $this->myquery($r);
    	if($r->query('dari') && $r->query('sampai')){
    		$data = $query
    		->whereBetween('tanggal', [$r->query('dari'), $r->query('sampai')])
    		->get();
    	}elseif($r->query('kategori')){
    		$data = $query
    		->where('id_kategori', $r->query('kategori'))
    		->get();
    	}elseif($r->query('vendor')){
    		$data = $query
    		->where('id_vendor', $r->query('vendor'))
    		->get();
    	}elseif($r->query('pelaksana')){
    		$data = $query
    		->where('id_karyawan', $r->query('pelaksana'))
    		->get();
    	}elseif($r->query('proyek')){
    		$data = $query
    		->where('id_proyek', $r->query('proyek'))
    		->get();
    	}
    	return view('pengeluaran.index', [
    		'data'      => $data,
    		'title'     => 'Pengeluaran',
    		'active'    => 'pengeluaran.index',
    		'createLink'=>route('pengeluaran.create'),
    		'listKategori'=>Kategori::selectMode(),
    		'listVendor'=>Vendor::selectMode(),
    		'listProyek'=>Proyek::selectMode(),
    		'listPelaksana'=>Karyawan::selectMode(),
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$p = Pengeluaran::orderBy('no','desc')->first();
    	return view('pengeluaran.tambah', [
    		'title'         => 'Tambah Pengeluaran',
    		'modul_link'    => url()->previous(),
    		'modul'         => 'Pengeluaran',
    		'action'        => route('pengeluaran.store'),
    		'active'        => 'pengeluaran.create',
    		'listVendor'=>Vendor::selectMode(),
    		'listProyek'=>Proyek::selectMode(),
    		'listPelaksana'=>Karyawan::selectMode(),
    		'listKategori'=>Kategori::selectMode(),
    		'no'=>is_null($p) ? 1 : $p->no+1,
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
    		'id_vendor'=>'required',
    		'id_karyawan'=>'required',
    		'nominal'=>'required|numeric',
    		'id_proyek'=>'required',
    		'id_kategori'=>'required',
    		'ref'=>'required',
    		'no'=>'required',
    		'tanggal'=>'required',
            'metode_pembayaran'=>'required',
    	]);
    	if(Pengeluaran::count() == 0){
    		DB::statement('set foreign_key_checks=0;');
    		Pengeluaran::truncate();
    	}
    	$kwitansi = null;
    	if($request->kwitansi){
	    	$kwitansi = $request->kwitansi->store('public/kwitansi');
	    	$kwitansi = url(str_replace('public/', 'storage/', $kwitansi));
    	}
        $id_vendor=$request->id_vendor;
        if($request->vendor_baru){
            $vendor = Vendor::create([
                'nama'        => $request->vendor_baru,
                'telp'        => '-',
                'alamat'      => '-',
                'keterangan'  => '-',
            ]);
            $id_vendor = $vendor->id;
        }
    	$pengeluaran = Pengeluaran::create([
    		'id_vendor'=>$id_vendor,
    		'id_karyawan'=>$request->id_karyawan,
    		'nominal'=>$request->nominal,
    		'metode_pembayaran'=>$request->metode_pembayaran,
    		'id_proyek'=>$request->id_proyek,
    		'id_kategori'=>$request->id_kategori,
    		'id_sub_kategori'=>$request->id_sub_kategori == 'Tidak ada sub' ? null : $request->id_sub_kategori,
    		'ref'=>$request->ref,
    		'kwitansi'=>$kwitansi,
    		'no'=>$request->no,
    		'tanggal'=>$this->englishFormat($request->tanggal),
            'deskripsi'=>$request->deskripsi,
            'user_id'=>Auth::id(),
    	]);
    	return redirect()->route('pengeluaran.index')->with('success_msg', 'Pengeluaran berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $klien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
    	$subk = Kategori::where('id_kategori',$pengeluaran->id_kategori)->get();
    	$subs = [];
    	foreach ($subk as $s) {
    		$subs[] = ['value'=>$s->id,'text'=>'['.$s->id.'] '.$s->nama];
    	}
    	return view('pengeluaran.ubah', [
    		'd'             => $pengeluaran,
    		'title'         => 'Ubah Pengeluaran',
    		'modul_link'    => url()->previous(),
    		'modul'         => 'Pengeluaran',
    		'action'        => route('pengeluaran.update', $pengeluaran->id),
    		'active'        => 'pengeluaran.edit',
    		'listVendor'=>Vendor::selectMode(),
    		'listProyek'=>Proyek::selectMode(),
    		'listPelaksana'=>Karyawan::selectMode(),
    		'listKategori'=>Kategori::selectMode(),
    		'subs'=>$subs,
            'tanggal'=>$this->formatIndo($pengeluaran->tanggal)
    	]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
    	$request->validate([
    		'id_vendor'=>'required',
    		'id_karyawan'=>'required',
    		'nominal'=>'required|numeric',
    		'id_proyek'=>'required',
    		'id_kategori'=>'required',
    		'ref'=>'required',
    		'no'=>'required',
    		'tanggal'=>'required',
            'metode_pembayaran'=>'required',
    	]);
    	$kwitansi = $pengeluaran->kwitansi;
    	if($request->kwitansi){
	    	$kwitansi = $request->kwitansi->store('public/kwitansi');
	    	$kwitansi = url(str_replace('public/', 'storage/', $kwitansi));
    	}
        $id_vendor=$request->id_vendor;
        if($request->vendor_baru){
            $vendor = Vendor::create([
                'nama'        => $request->vendor_baru,
                'telp'        => '-',
                'alamat'      => '-',
                'keterangan'  => '-',
            ]);
            $id_vendor = $vendor->id;
        }
    	$pengeluaran->update([
    		'id_vendor'=>$id_vendor,
    		'id_karyawan'=>$request->id_karyawan,
    		'nominal'=>$request->nominal,
            'metode_pembayaran'=>$request->metode_pembayaran,
    		'id_proyek'=>$request->id_proyek,
    		'id_kategori'=>$request->id_kategori,
    		'id_sub_kategori'=>$request->id_sub_kategori == 'Tidak ada sub' ? null : $request->id_sub_kategori,
    		'ref'=>$request->ref,
    		'kwitansi'=>$kwitansi,
    		'no'=>$request->no,
            'deskripsi'=>$request->deskripsi,
    		'tanggal'=>$this->englishFormat($request->tanggal),
            'user_id'=>Auth::id(),
    	]);
    	return redirect()->route('pengeluaran.index')->with('success_msg', 'Pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengeluaran  $klien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
    	$pengeluaran->delete();
    	return redirect()->back()->with('success_msg', 'Pengeluaran berhasil dihapus');
    }

    public function byWaktu(Request $r)
    {
    	$data = [];
        $dari = $this->englishFormat($r->query('dari'));
        $sampai = $this->englishFormat($r->query('sampai'));
    	$query = $this->myquery($r);
    	if($r->query('dari') && $r->query('sampai')){
    		$data = $query
    		->whereBetween('tanggal', [$dari, $sampai])
    		->get();
    	}
    	return view('pengeluaran.by-waktu', [
    		'data'      => $data,
    		'title'     => 'Pengeluaran By Waktu',
    		'active'    => 'pengeluaran.by-waktu',
    		'createLink'=>route('pengeluaran.create'),
    	]);
    }

    public function byProyek(Request $r)
    {
    	$data = [];
    	$query = $this->myquery($r);
    	if($r->query('proyek')){
    		$data = $query
    		->where('id_proyek', $r->query('proyek'))
    		->get();
    	}
    	return view('pengeluaran.by-proyek', [
    		'data'      => $data,
    		'title'     => 'Pengeluaran By Proyek',
    		'active'    => 'pengeluaran.by-proyek',
    		'createLink'=>route('pengeluaran.create'),
    		'listProyek'=>Proyek::selectMode(),
    	]);
    }

    public function byKategori(Request $r)
    {
    	$data = [];
    	$query = $this->myquery($r);
    	if($r->query('kategori')){
    		$data = $query
    		->where('id_kategori', $r->query('kategori'))
    		->get();
    	}
    	return view('pengeluaran.by-kategori', [
    		'data'      => $data,
    		'title'     => 'Pengeluaran By Kategori',
    		'active'    => 'pengeluaran.by-kategori',
    		'createLink'=>route('pengeluaran.create'),
    		'listKategori'=>Kategori::selectMode(),
    	]);
    }

    private function myquery($r)
    {
        $query = Pengeluaran::with('vendor','proyek','kategori','subkategori','pelaksana');
        $user = $r->user();
        if(isset($user->hakakses->menu->pengeluaran_user_saat_ini)){
            $query = $query->where('user_id', $user->id);
        }
        return $query;
    }

    public function byPelaksana(Request $r)
    {
    	$data = [];
    	$query = $this->myquery($r);
    	if($r->query('pelaksana')){
    		$data = $query
    		->where('id_karyawan', $r->query('pelaksana'))
    		->get();
    	}
    	return view('pengeluaran.by-pelaksana', [
    		'data'      => $data,
    		'title'     => 'Pengeluaran By Pelaksana',
    		'active'    => 'pengeluaran.by-pelaksana',
    		'createLink'=>route('pengeluaran.create'),
    		'listPelaksana'=>Karyawan::selectMode(),
    	]);
    }

    public function byVendor(Request $r)
    {
    	$data = [];
    	$query = $this->myquery($r);
    	if($r->query('vendor')){
    		$data = $query
    		->where('id_vendor', $r->query('vendor'))
    		->get();
    	}
    	return view('pengeluaran.by-vendor', [
    		'data'      => $data,
    		'title'     => 'Pengeluaran By Vendor',
    		'active'    => 'pengeluaran.by-vendor',
    		'createLink'=>route('pengeluaran.create'),
    		'listVendor'=>Vendor::selectMode(),
    	]);
    }

  }

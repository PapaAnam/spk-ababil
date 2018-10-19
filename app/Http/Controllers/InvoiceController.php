<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use App\Klien;
use App\Rekening;
use App\Proyek;
use DB;
use App\Mytrait\Tanggal;

class InvoiceController extends Controller
{

    use Tanggal;

    public function __construct()
    {
        $this->middleware('myrole:superadmin,finance')->only('index','create','store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.tambah', [
            'title'         => 'Tambah Invoice',
            'modul_link'    => url()->previous(),
            'modul'         => 'Invoice',
            'action'        => route('invoice.store'),
            'active'        => 'invoice.create',
            // 'listProyek'=>Proyek::selectMode(),
            'listKlien'=>Klien::selectMode(),
            'listRekening'=>Rekening::selectMode(),
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
            'tanggal'=>'required',
            'id_klien'=>'required',
            'id_proyek'=>'required',
            'total_tagihan'=>'required|numeric',
            'terbayar'=>'required|numeric',
            'tertagih'=>'required|numeric',
            'id_rekening'=>'required',
            'nama_pajak'=>'required|array',
            'pajak'=>'required|array',
            'nama_pajak.*'=>'required',
            'pajak.*'=>'required|numeric',
        ]);
        if(Invoice::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Invoice::truncate();
        }
        $invoice = Invoice::create([
            'tanggal'=>$this->englishFormat($request->tanggal),
            'id_proyek'=>$request->id_proyek,
            'total_tagihan'=>$request->total_tagihan,
            'terbayar'=>$request->terbayar,
            'tertagih'=>$request->tertagih,
            'id_rekening'=>$request->id_rekening,
            'id_user'=>$request->user()->id,
            'deskripsi'=>$request->deskripsi,
        ]);
        if($invoice->id <= 9){
            $no_invoice = '000'.$invoice->id;
        }elseif($invoice->id <= 99){
            $no_invoice = '00'.$invoice->id;
        }elseif($invoice->id <= 999){
            $no_invoice = '00'.$invoice->id;
        }elseif($invoice->id >=1000){
            $no_invoice = $invoice->id;
        }
        $no_invoice .= '/'.date('dm').'/'.date('Y');
        $invoice->update([
            'no_invoice'=>$no_invoice
        ]);
        $i = 0;
        foreach ($request->nama_pajak as $namaPajak) {
            $invoice->pajak()->create([
                'nama'=>$namaPajak,
                'pajak'=>$request->pajak[$i++]
            ]);
        }
        return redirect()->back()->with('success_msg', 'Invoice berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $p = Proyek::find($invoice->id_proyek);
        return view('invoice.ubah', [
            'd'             => $invoice,
            'title'         => 'Ubah Invoice',
            'modul_link'    => url()->previous(),
            'modul'         => 'Invoice',
            'action'        => route('invoice.update', $invoice->id),
            'active'        => 'invoice.edit',
            'listProyek'=>Proyek::selectMode(['klien', $p->klien]),
            'listKlien'=>Klien::selectMode(),
            'listRekening'=>Rekening::selectMode(),
            'tanggal'=>$this->formatIndo($invoice->tanggal),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'tanggal'=>'required',
            'id_klien'=>'required',
            'id_proyek'=>'required',
            'total_tagihan'=>'required|numeric',
            'terbayar'=>'required|numeric',
            'tertagih'=>'required|numeric',
            'id_rekening'=>'required',
            'nama_pajak'=>'required|array',
            'pajak'=>'required|array',
            'nama_pajak.*'=>'required',
            'pajak.*'=>'required|numeric',
        ]);
        $invoice->update([
            'tanggal'=>$this->englishFormat($request->tanggal),
            'id_proyek'=>$request->id_proyek,
            'total_tagihan'=>$request->total_tagihan,
            'terbayar'=>$request->terbayar,
            'tertagih'=>$request->tertagih,
            'id_rekening'=>$request->id_rekening,
            'id_user'=>$request->user()->id,
            'deskripsi'=>$request->deskripsi,
        ]);
        $invoice->pajak()->delete();
        $i = 0;
        foreach ($request->nama_pajak as $namaPajak) {
            $invoice->pajak()->create([
                'nama'=>$namaPajak,
                'pajak'=>$request->pajak[$i++]
            ]);
        }
        return redirect()->back()->with('success_msg', 'Invoice berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->back()->with('success_msg', 'Invoice berhasil dihapus');
    }

    public function byWaktu(Request $r)
    {
        $data = [];
        $dari = $this->englishFormat($r->query('dari'));
        $sampai = $this->englishFormat($r->query('sampai'));
        if($r->query('dari') && $r->query('sampai')){
            $data = Invoice::with('proyek.kliendetail.pic', 'ttd', 'pajak', 'rekening')
            ->whereBetween('tanggal', [$dari, $sampai])->get();
        }
        return view('invoice.by-waktu', [
            'data'      => $data,
            'title'     => 'Invoice By Waktu',
            'active'    => 'invoice.by-waktu',
            'createLink'=>route('invoice.create'),
            'role'=>[
                'finance','superadmin'
            ],
        ]);
    }

    public function byKlien(Request $r)
    {
        $data = [];
        if($r->query('klien')){
            $data = Invoice::with('proyek.kliendetail.pic', 'ttd', 'pajak', 'rekening')->get()->transform(function($item) use ($r){
                if($item->proyek->klien == $r->klien){
                    return $item;
                }
            })->values()->reject(function($item){
                return is_null($item);
            })->values();
        }
        return view('invoice.by-klien', [
            'data'      => $data,
            'title'     => 'Invoice By Klien',
            'active'    => 'invoice.by-klien',
            'createLink'=>route('invoice.create'),
            'role'=>[
                'finance','superadmin'
            ],
            'listKlien'=>Klien::selectMode(),
        ]);
    }

    public function byProyek(Request $r)
    {
        $data = [];
        if($r->query('proyek')){
            $data = Invoice::with('proyek.kliendetail.pic', 'ttd', 'pajak', 'rekening')
            ->where('id_proyek', $r->query('proyek'))
            ->get();
        }
        return view('invoice.by-proyek', [
            'data'      => $data,
            'title'     => 'Invoice By Proyek',
            'active'    => 'invoice.by-proyek',
            'createLink'=>route('invoice.create'),
            'role'=>[
                'finance','superadmin'
            ],
            'listProyek'=>Proyek::selectMode(),
        ]);
    }

}

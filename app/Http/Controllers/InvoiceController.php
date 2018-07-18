<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use App\Klien;
use App\Rekening;
use App\Proyek;
use DB;
class InvoiceController extends Controller
{
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
        $data = [];
        if($r->query('dari') && $r->query('sampai')){
            $data = Invoice::with('proyek.kliendetail.pic', 'ttd', 'pajak', 'rekening')
            ->whereBetween('tanggal', [$r->dari, $r->sampai])->get();
        }
        elseif($r->query('klien')){
            $data = Invoice::with('proyek.kliendetail.pic', 'ttd', 'pajak', 'rekening')->get()->transform(function($item) use ($r){
                if($item->proyek->klien == $r->klien){
                    return $item;
                }
            })->values()->reject(function($item){
                return is_null($item);
            })->values();
        }
        return view('invoice.index', [
            'data'      => $data,
            'title'     => 'Invoice',
            'active'    => 'invoice.index',
            'createLink'=>route('invoice.create'),
            'role'=>[
                'finance','superadmin'
            ],
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
        return view('invoice.tambah', [
            'title'         => 'Tambah Invoice',
            'modul_link'    => route('invoice.index'),
            'modul'         => 'Invoice',
            'action'        => route('invoice.store'),
            'active'        => 'invoice.index',
            'listProyek'=>Proyek::selectMode(),
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
            // 'no_invoice'=>'required',
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
            'tanggal'=>$request->tanggal,
            'id_proyek'=>$request->id_proyek,
            'total_tagihan'=>$request->total_tagihan,
            'terbayar'=>$request->terbayar,
            'tertagih'=>$request->tertagih,
            'id_rekening'=>$request->id_rekening,
            'id_user'=>$request->user()->id,
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
        return redirect()->route('invoice.index')->with('success_msg', 'Invoice berhasil dibuat');
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
        return view('invoice.ubah', [
            'd'             => $invoice,
            'title'         => 'Ubah Invoice',
            'modul_link'    => route('invoice.index'),
            'modul'         => 'Invoice',
            'action'        => route('invoice.update', $invoice->id),
            'active'        => 'invoice.edit',
            'listProyek'=>Proyek::selectMode(),
            'listCuaca'=>$this->getListCuaca(),
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
            'id_proyek'=>'required',
            'ritase'=>'required|numeric',
            'cuaca'=>'required',
            'tanggal'=>'required|date_format:Y-m-d',
        ]);
        $invoice->update([
            'tanggal'=>$request->tanggal,
            'cuaca'=>$request->cuaca,
            'deskripsi'=>$request->deskripsi,
            'ritase'=>$request->ritase,
            'id_proyek'=>$request->id_proyek,
            'kendala'=>$request->kendala
        ]);
        $invoice->material()->delete();
        // set material
        $proyek = Proyek::with('tugas')->where('id', $request->id_proyek)->first();
        $invoice->material()->create([
            'qty'=>$proyek->qty,
            'tipe'=>'proyek'
        ]);
        foreach ($proyek->tugas as $tugas) {
            $invoice->material()->create([
                'qty'=>$tugas->qty,
                'tipe'=>'tugas'
            ]);
        }
        return redirect()->route('invoice.index')->with('success_msg', 'Invoice berhasil diperbarui');
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
        return redirect()->route('invoice.index')->with('success_msg', 'Invoice berhasil dihapus');
    }
}

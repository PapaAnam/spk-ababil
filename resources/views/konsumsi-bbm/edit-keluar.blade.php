@extends('create-form')
@section('form')
@method('PUT')
@include('datepicker',['id'=>'tanggal_keluar','label'=>'Tanggal Keluar','value'=>formatIndo($d->tanggal_keluar)])
@include('input_number',['id'=>'qty_keluar','label'=>'Qty Keluar','value'=>$d->qty_keluar])
@include('textarea',['id'=>'keterangan_keluar','label'=>'Keterangan Keluar','value'=>$d->keterangan_keluar])
@include('karyawan.pelaksana',['selected'=>$d->id_karyawan])
@include('proyek.list',['selected'=>$d->id_proyek])
@include('armada.list',['selected'=>$d->id_armada])
@endsection

@include('import-select2')
@include('import-datepicker')
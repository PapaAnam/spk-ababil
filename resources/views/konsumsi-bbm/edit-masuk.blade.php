@extends('create-form')
@section('form')
@method('put')
@include('datepicker',['id'=>'tanggal_masuk','value'=>formatIndo($d->tanggal_masuk),'label'=>'Tanggal Masuk'])
@include('input_number',['id'=>'qty_masuk','value'=>$d->qty_masuk,'label'=>'Qty Masuk'])
@include('textarea',['id'=>'keterangan_masuk','value'=>$d->keterangan_masuk,'label'=>'Keterangan Masuk'])
@include('vendor.list',['selected'=>$d->id_vendor])
@endsection

@include('import-select2')
@include('import-datepicker')
@extends('create-form')
@section('form')
@include('datepicker',['id'=>'tanggal_masuk','label'=>'Tanggal Masuk'])
@include('input_number',['id'=>'qty_masuk','label'=>'Qty Masuk'])
@include('textarea',['id'=>'keterangan_masuk','label'=>'Keterangan Masuk'])
@include('vendor.list')
@endsection

@include('import-select2')
@include('import-datepicker')
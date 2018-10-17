@extends('create-form')
@section('form')
@include('datepicker',['id'=>'tanggal_keluar','label'=>'Tanggal Keluar'])
@include('input_number',['id'=>'qty_keluar','label'=>'Qty Keluar'])
@include('textarea',['id'=>'keterangan_keluar','label'=>'Keterangan Keluar'])
@include('karyawan.pelaksana')
@include('proyek.list')
@include('armada.list')
@endsection

@include('import-select2')
@include('import-datepicker')
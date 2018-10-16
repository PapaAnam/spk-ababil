@extends('create-form')
@section('form')
@include('input',['id'=>'nama','label'=>'Nama'])
@include('select2-no-tags',['id'=>'klien','label'=>'Pilih Klien','selectData'=>$listKlien])
@include('select2',['id'=>'pelaksana','label'=>'Pilih Pelaksana','selectData'=>$listKaryawan])
@include('input_number',['id'=>'qty','label'=>'Qty'])
@include('select',['id'=>'satuan','label'=>'Pilih Satuan','selectData'=>$listSatuan])
@include('datepicker',['id'=>'start_date','label'=>'Start Date'])
@include('datepicker',['id'=>'end_date','label'=>'End Date'])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi'])
@endsection

@include('import-datepicker')
@include('import-select2')
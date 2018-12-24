@extends('create-form')
@section('form')
@include('select2-no-tags',['id'=>'id_proyek','label'=>'Pilih Proyek','selectData'=>$listProyek])
@include('input',['id'=>'nama_tugas','label'=>'Nama Tugas'])
@include('select2',['id'=>'pelaksana','label'=>'Pilih Pelaksana','selectData'=>$listKaryawan])
@include('input',['id'=>'material','label'=>'Material'])
@include('input',['id'=>'qty','label'=>'Qty','hint'=>'Gunakan (.) untuk desimal'])
@include('select2-no-tags',['id'=>'satuan','label'=>'Pilih Satuan','selectData'=>$listSatuan])
@include('datepicker',['id'=>'start_date','label'=>'Start Date','value'=>date('d-m-Y')])
@include('datepicker',['id'=>'end_date','label'=>'End Date'])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','value'=>'-'])
@endsection

@include('import-datepicker')
@include('import-select2')
{{-- @include('import-inputmask') --}}
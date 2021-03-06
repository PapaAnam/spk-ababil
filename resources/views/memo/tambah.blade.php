@extends('create-form')
@section('form')
@include('tanggal')
@include('datepicker',['id'=>'deadline','label'=>'Deadline'])
@include('karyawan.pelaksana-tags')
@include('select2',['id'=>'jenis_karyawan','label'=>'Jenis Karyawan','selectData'=>[
	['text'=>'Sopir','value'=>'Sopir'],
	['text'=>'Operator','value'=>'Operator'],
	['text'=>'Office','value'=>'Office'],
	]])
@include('proyek.list')
@include('klien.list')
@include('textarea',['id'=>'pesan','label'=>'Pesan'])
@endsection
@include('import-datepicker')
@include('import-select2')
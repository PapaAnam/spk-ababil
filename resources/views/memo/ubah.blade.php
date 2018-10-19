@extends('create-form')
@section('form')
@method('PUT')
@include('tanggal',['value'=>formatIndo($d->deadline)])
@include('datepicker',['id'=>'deadline','label'=>'Deadline','value'=>formatIndo($d->deadline)])
@include('karyawan.pelaksana-tags',['selected'=>$d->pelaksana->pluck('id_karyawan')->toArray()])
@include('select2',['id'=>'jenis_karyawan[]','label'=>'Jenis Karyawan','selectData'=>[['text'=>'Sopir','value'=>'Sopir'],['text'=>'Operator','value'=>'Operator'],['text'=>'Office','value'=>'Office'],],'selected'=>$d->jeniskaryawan->pluck('id')->toArray()])
@include('proyek.list',['selected'=>$d->id_proyek])
@include('klien.list',['selected'=>$d->id_klien])
@include('textarea',['id'=>'pesan','label'=>'Pesan','value'=>$d->pesan])
@endsection

@include('import-datepicker')
@include('import-select2')
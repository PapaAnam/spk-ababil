@extends('create-form')
@section('form')
@method('PUT')
@include('input_readonly',['value'=>$d->nama,'id'=>'nama','label'=>'Nama Proyek'])
@include('input_readonly',['value'=>$d->kliendetail->nama_perusahaan,'id'=>'klien','label'=>'Klien'])
@include('input_readonly',['value'=>$d->qty,'id'=>'qty','label'=>'Qty'])
@include('input_readonly',['value'=>$d->satuandetail->nama,'id'=>'satuan','label'=>'Satuan'])
@include('input_readonly',['value'=>$d->start_date_indo,'id'=>'start_date','label'=>'Start Date'])
@include('input_readonly',['value'=>$d->end_date_indo,'id'=>'end_date','label'=>'End Date'])
@include('textarea_readonly',['value'=>$d->deskripsi,'id'=>'deskripsi','label'=>'Deskripsi'])
<h4>Pelaksana</h4>
@foreach($d->pelaksana as $pelaksana)
@include('input_readonly',['value'=>$pelaksana->karyawan->nama,'id'=>'pelaksana','label'=>'Pelaksana '.$loop->iteration])
@endforeach
@endsection
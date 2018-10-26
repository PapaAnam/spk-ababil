@extends('create-form')
@section('form')
@method('PUT')
@include('input',['value'=>$d->nama,'id'=>'nama','label'=>'Nama'])
@include('input',['value'=>$d->telp,'id'=>'telp','label'=>'No Telp'])
@include('input',['id'=>'no_rekening','label'=>'No Rekening','value'=>$d->no_rekening])
@include('textarea',['value'=>$d->alamat,'id'=>'alamat','label'=>'Alamat'])
@include('textarea',['value'=>$d->keterangan,'id'=>'keterangan','label'=>'Keterangan'])
@endsection
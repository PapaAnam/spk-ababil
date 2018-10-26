@extends('create-form')
@section('form')
@include('input',['id'=>'nama','label'=>'Nama'])
@include('input',['id'=>'telp','label'=>'No Telp'])
@include('input',['id'=>'no_rekening','label'=>'No Rekening'])
@include('textarea',['id'=>'alamat','label'=>'Alamat'])
@include('textarea',['id'=>'keterangan','label'=>'Keterangan'])
@endsection
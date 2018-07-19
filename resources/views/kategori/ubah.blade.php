@extends('create-form')
@section('form')
@method('put')
@include('input',['id'=>'nama','label'=>'Nama Kategori','value'=>$d->nama])
@endsection
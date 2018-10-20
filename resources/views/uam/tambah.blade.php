@extends('create-form')
@section('form')
@include('input',['id'=>'nama_lengkap','label'=>'Nama Lengkap'])
@include('input',['id'=>'jabatan','label'=>'Jabatan'])
@include('input_email',['id'=>'email','label'=>'Email'])
@include('input_password',['id'=>'password','label'=>'Password'])
@include('select2-no-tags',['id'=>'role','label'=>'Role','selectData'=>$listRole])
@include('uam.hak-akses')
@endsection

@include('uam.script')
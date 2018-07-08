@extends('create-form')
@section('form')
@method('PUT')
@include('input_number',['value'=>$d->nik,'id'=>'nik','label'=>'NIK'])
@include('input',['value'=>$d->nama,'id'=>'nama','label'=>'Nama'])
@include('input',['value'=>$d->no_hp,'id'=>'no_hp','label'=>'No HP'])
@include('input',['value'=>$d->no_darurat,'id'=>'no_darurat','label'=>'No Darurat'])
@include('input',['value'=>$d->jabatan,'id'=>'jabatan','label'=>'Jabatan'])
@include('textarea',['value'=>$d->alamat,'id'=>'alamat','label'=>'Alamat'])
@include('input',['value'=>$d->armada,'id'=>'armada','label'=>'Armada'])
@include('input_number',['value'=>$d->gaji_pokok,'id'=>'gaji_pokok','label'=>'Gaji Pokok'])
@include('input_number',['value'=>$d->rate_per_jam,'id'=>'rate_per_jam','label'=>'Rate Per Jam'])
@include('input_number',['value'=>$d->um_harian,'id'=>'um_harian','label'=>'UM Harian'])
@include('input_number',['value'=>$d->rate_lembur,'id'=>'rate_lembur','label'=>'Rate Lembur'])
@include('input_number',['value'=>$d->insentif,'id'=>'insentif','label'=>'Insentif'])
@endsection
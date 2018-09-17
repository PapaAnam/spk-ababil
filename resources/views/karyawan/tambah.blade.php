@extends('create-form')
@section('form')
@include('input_number',['id'=>'nik','label'=>'NIK'])
@include('input',['id'=>'nama','label'=>'Nama'])
@include('textarea',['id'=>'alamat','label'=>'Alamat'])
@include('input_number',['id'=>'no_rek','label'=>'No Rekening'])
@include('input',['id'=>'atas_nama','label'=>'Atas Nama'])
@include('input',['id'=>'no_hp','label'=>'No HP'])
@include('input',['id'=>'no_darurat','label'=>'No Darurat'])
@include('input',['id'=>'jabatan','label'=>'Jabatan'])
@include('input',['id'=>'armada','label'=>'Armada'])
@include('input_number',['id'=>'gaji_pokok','label'=>'Gaji Pokok'])
@include('input_number',['id'=>'um_harian','label'=>'UM Harian'])
@include('input_number',['id'=>'rate_lembur','label'=>'Rate Lembur'])
@include('select',['id'=>'jenis','label'=>'Jenis Karyawan','selectData'=>$listJenis])
@include('input_number',['id'=>'rate_per_jam','label'=>'Rate Per Jam'])
@include('input_number',['id'=>'insentif','label'=>'Insentif'])
@endsection

@include('karyawan.script')
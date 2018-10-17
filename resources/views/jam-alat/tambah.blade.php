@extends('create-form')
@section('form')
@include('timemask',['id'=>'jam_mulai','label'=>'Jam Mulai'])
@include('timemask',['id'=>'jam_selesai','label'=>'Jam Selesai'])
@include('textarea',['id'=>'pekerjaan','label'=>'Pekerjaan'])
@include('select2-no-tags',['id'=>'id_armada','label'=>'Pilih Armada','selectData'=>$listArmada])
@endsection

@include('import-select2')
@include('import-timemask')
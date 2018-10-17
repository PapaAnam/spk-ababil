@extends('create-form')
@section('form')
@method('PUT')
@include('timemask',['id'=>'jam_mulai','value'=>$d->jam_mulai,'label'=>'Jam Mulai'])
@include('timemask',['id'=>'jam_selesai','value'=>$d->jam_selesai,'label'=>'Jam Selesai'])
@include('textarea',['id'=>'pekerjaan','value'=>$d->pekerjaan,'label'=>'Pekerjaan'])
@include('select2-no-tags',['id'=>'id_armada','label'=>'Pilih Armada','selectData'=>$listArmada,'selected'=>$d->id_armada])
@endsection

@include('import-select2')
@include('import-datepicker')
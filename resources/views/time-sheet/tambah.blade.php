@extends('create-form')
@section('form')
@include('select2-no-tags',['id'=>'id_karyawan','label'=>'Karyawan','selectData'=>$listKaryawan])
@include('datepicker',['id'=>'tanggal','label'=>'Tanggal'])
@include('timemask',['id'=>'jam_mulai','label'=>'Jam Mulai'])
@include('timemask',['id'=>'jam_selesai','label'=>'Jam Selesai'])
{{-- @include('input',['id'=>'ritase','label'=>'Ritase']) --}}
{{-- @include('input',['id'=>'lembur','label'=>'Lembur','value'=>0]) --}}
@include('input',['id'=>'istirahat','label'=>'Istirahat','value'=>0])
<div id="tambahan">	</div>
@endsection

@include('import-datepicker')
@include('import-timemask')
@include('import-select2')

@include('time-sheet.script')
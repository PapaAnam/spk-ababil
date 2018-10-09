@extends('create-form')
@section('form')
@method('PUT')
@include('input_readonly',['value'=>$d->id,'id'=>'id','label'=>'ID Karyawan'])
@include('input_readonly',['value'=>$d->nik,'id'=>'nik','label'=>'NIK'])
@include('input_readonly',['value'=>$d->nama,'id'=>'nama','label'=>'Nama'])
@include('input_readonly',['value'=>$d->no_hp,'id'=>'no_hp','label'=>'No HP'])
@include('input_readonly',['value'=>$d->no_darurat,'id'=>'no_darurat','label'=>'No Darurat'])
@include('input_readonly',['value'=>$d->jabatan,'id'=>'jabatan','label'=>'Jabatan'])
@include('textarea_readonly',['value'=>$d->alamat,'id'=>'alamat','label'=>'Alamat'])
@include('input_readonly',['value'=>$d->armada,'id'=>'armada','label'=>'Armada'])
@include('input_readonly',['value'=>$d->gaji_pokok_rp,'id'=>'gaji_pokok','label'=>'Gaji Pokok'])
@include('input_readonly',['value'=>$d->um_harian_rp,'id'=>'um_harian','label'=>'UM Harian'])
{{-- @include('input_readonly',['value'=>$d->rate_lembur_rp,'id'=>'rate_lembur','label'=>'Rate Lembur']) --}}
@include('input_readonly',['value'=>$d->jenis,'id'=>'jenis','label'=>'Jenis Karyawan'])
@if($d->jenis == 'Operator')
@include('input_readonly',['value'=>$d->rate_per_jam_rp,'id'=>'rate_per_jam','label'=>'Rate Per Jam'])
@foreach($d->overtime as $ot)
@include('input_readonly',['value'=>$ot->nama,'id'=>'nama_overtime','label'=>'Nama Overtime '.$loop->iteration])
@include('input_readonly',['value'=>number_format($ot->rate_overtime,0,',','.'),'id'=>'rate_overtime','label'=>'Rate Overtime '.$loop->iteration])
<hr>
@endforeach
@elseif($d->jenis == 'Sopir')
@foreach($d->insentifdetail as $ins)
@include('input_readonly',['value'=>$ins->nama,'id'=>'nama_insentif','label'=>'Nama Insentif '.$loop->iteration])
@include('input_readonly',['value'=>number_format($ins->insentif,0,',','.'),'id'=>'insentif','label'=>'Insentif '.$loop->iteration])
@include('input_readonly',['value'=>number_format($ins->lembur,0,',','.'),'id'=>'lembur','label'=>'Lembur '.$loop->iteration])
<hr>
@endforeach
@endif
@endsection
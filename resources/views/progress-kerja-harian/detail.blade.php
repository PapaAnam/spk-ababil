@extends('create-form')
@section('form')
@method('PUT')
@include('input_readonly',['id'=>'tanggal','label'=>'Tanggal','value'=>tglIndo($d->tanggal)])
@include('input_readonly',['id'=>'Proyek','label'=>'Proyek','readonly'=>true,'value'=>$d->proyek->nama])
@include('input_readonly',['id'=>'Tugas','label'=>'Tugas','readonly'=>true,'value'=>$d->tugas->nama_tugas])
@include('input_readonly',['id'=>'material','label'=>'Material','readonly'=>true,'value'=>$d->tugas->material])
@include('input_readonly',['id'=>'qty','label'=>'Qty','readonly'=>true,'value'=>$d->tugas->qty])
@include('input_readonly',['id'=>'ritase','label'=>'Ritase','value'=>$d->ritase])
@include('input_readonly',['id'=>'qty2','label'=>'Qty','value'=>$d->qty])
@include('input',['id'=>'Cuaca','label'=>'Cuaca','readonly'=>true,'value'=>$d->cuaca])
@include('textarea',['readonly'=>true,'id'=>'deskripsi','label'=>'Deskripsi','value'=>$d->deskripsi])
@include('textarea',['readonly'=>true,'id'=>'kendala','label'=>'Kendala','value'=>$d->kendala])
@foreach ($d->foto as $f)
<div class="form-group">
  <label for="attach_foto" class="col-lg-2 control-label">Attach Foto</label>
  <div class="col-sm-6">
  	<a target="_blank" href="{{$f->url}}">
    <img style="max-width: 300px;" src="{{$f->url}}" alt="Attach Foto ke {{$loop->iteration}}">
    </a>
  </div>
</div>
@endforeach
@endsection
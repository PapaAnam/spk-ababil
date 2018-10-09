@extends('create-form')
@section('form')
@method('PUT')
@include('input_number',['value'=>$d->nik,'id'=>'nik','label'=>'NIK'])
@include('input',['value'=>$d->nama,'id'=>'nama','label'=>'Nama'])
@include('input',['value'=>$d->no_hp,'id'=>'no_hp','label'=>'No HP'])
@include('input_number',['id'=>'no_rek','label'=>'No Rekening','value'=>$d->no_rek])
@include('input',['id'=>'atas_nama','label'=>'Atas Nama','value'=>$d->atas_nama])
@include('input',['value'=>$d->no_darurat,'id'=>'no_darurat','label'=>'No Darurat'])
@include('input',['value'=>$d->jabatan,'id'=>'jabatan','label'=>'Jabatan'])
@include('textarea',['value'=>$d->alamat,'id'=>'alamat','label'=>'Alamat'])
@include('input',['value'=>$d->armada,'id'=>'armada','label'=>'Armada'])
@include('input_number',['value'=>$d->gaji_pokok,'id'=>'gaji_pokok','label'=>'Gaji Pokok'])
@include('input_number',['value'=>$d->um_harian,'id'=>'um_harian','label'=>'UM Harian'])
{{-- @include('input_number',['value'=>$d->rate_lembur,'id'=>'rate_lembur','label'=>'Rate Lembur']) --}}
@include('select',['id'=>'jenis','label'=>'Jenis Karyawan','selectData'=>$listJenis,'selected'=>$d->jenis])
{{-- @if(count($errors->all()) > 0)
<div id="operator-area">
	@include('input',['id'=>'nama_overtime','name'=>'nama_overtime[]','label'=>'Nama Overtime','index'=>0])
	@include('input_number',['id'=>'rate_overtime','name'=>'rate_overtime[]','label'=>'Rate Overtime','index'=>0])
	<div class="form-group">
		<label for="" class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<a href="#" id="tombol-tambah-ot" class="btn btn-primary btn-flat">Tambah OT</a>
		</div>
	</div>
	<div id="operator-tambahan">
		@if(count(old('nama_overtime')) > 1)
		@foreach(old('nama_overtime') as $er)
		@if($loop->index != 0)
		@include('input',['id'=>'nama_overtime','name'=>'nama_overtime[]','label'=>'Nama Overtime','index'=>$loop->index])
		@include('input_number',['id'=>'rate_overtime','name'=>'rate_overtime[]','label'=>'Rate Overtime','index'=>$loop->index])
		<div class="form-group">
			<label for="" class="col-lg-2 control-label"></label>
			<div class="col-sm-6">
				<a href="#" class="tombol-hapus-ot btn btn-danger btn-flat">Hapus</a>
			</div>
		</div>
		@endif
		@endforeach
		@endif
	</div>
</div>
<div id="sopir-area">
	@include('input',['id'=>'nama_insentif','name'=>'nama_insentif[]','label'=>'Nama Insentif','index'=>0])
	@include('input_number',['id'=>'insentif','name'=>'insentif[]','label'=>'Insentif','index'=>0])
	@include('input_number',['id'=>'lembur','name'=>'lembur[]','label'=>'Lembur','index'=>0])
	<div class="form-group">
		<label for="" class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<a href="#" id="tombol-tambah-insentif" class="btn btn-primary btn-flat">Tambah Insentif</a>
		</div>
	</div>
	<div id="sopir-tambahan">
		@if(count(old('nama_insentif')) > 1)
		@foreach(old('nama_insentif') as $er)
		@if($loop->index != 0)
		@include('input',['id'=>'nama_insentif','name'=>'nama_insentif[]','label'=>'Nama Insentif','index'=>$loop->index])
		@include('input_number',['id'=>'insentif','name'=>'insentif[]','label'=>'Insentif','index'=>$loop->index])
		@include('input_number',['id'=>'lembur','name'=>'lembur[]','label'=>$loop->index])
		<div class="form-group">
			<label for="" class="col-lg-2 control-label"></label>
			<div class="col-sm-6">
				<a href="#" class="tombol-hapus-insentif btn btn-danger btn-flat">Hapus</a>
			</div>
		</div>
		@endif
		@endforeach
		@endif
	</div>
</div>
@else
<div id="operator-area">
	@include('input',['id'=>'nama_overtime','name'=>'nama_overtime[]','label'=>'Nama Overtime'])
	@include('input_number',['id'=>'rate_overtime','name'=>'rate_overtime[]','label'=>'Rate Overtime'])
	<div class="form-group">
		<label for="" class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<a href="#" id="tombol-tambah-ot" class="btn btn-primary btn-flat">Tambah OT</a>
		</div>
	</div>
	<div id="operator-tambahan"></div>
</div>
<div id="sopir-area">
	@include('input',['id'=>'nama_insentif','name'=>'nama_insentif[]','label'=>'Nama Insentif'])
	@include('input_number',['id'=>'insentif','name'=>'insentif[]','label'=>'Insentif'])
	@include('input_number',['id'=>'lembur','name'=>'lembur[]','label'=>'Lembur'])
	<div class="form-group">
		<label for="" class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<a href="#" id="tombol-tambah-insentif" class="btn btn-primary btn-flat">Tambah Insentif</a>
		</div>
	</div>
	<div id="sopir-tambahan"></div>
</div>
@endif --}}
{{-- @include('input_number',['value'=>$d->rate_per_jam,'id'=>'rate_per_jam','label'=>'Rate Per Jam']) --}}
{{-- @include('input_number',['value'=>$d->insentif,'id'=>'insentif','label'=>'Insentif']) --}}
@endsection

@push('script')
<script>
	$(document).ready(function(){
		$('select#jenis').on('change', function(){
			var jenis = $(this).val();
			if(jenis){
				if(jenis == 'Operator'){
					$('#rate_per_jam').parent().parent().show();
					$('#insentif').parent().parent().fadeOut();
				}else if(jenis == 'Sopir'){
					$('#rate_per_jam').parent().parent().fadeOut();
					$('#insentif').parent().parent().show();
				}else{
					$('#rate_per_jam').parent().parent().fadeOut();
					$('#insentif').parent().parent().fadeOut();
				}
				$('#rate_per_jam').val({{$d->rate_per_jam}});
				$('#insentif').val({{$d->insentif}});
			}else{
				alert('Pilih salah satu jenis karyawan terlebih dahulu!!!');
			}
		});
		@if($d->jenis != 'Sopir')
		$('#insentif').parent().parent().fadeOut();
		$('#insentif').val(0);
		@endif
		@if($d->jenis != 'Operator')
		$('#rate_per_jam').parent().parent().fadeOut();
		$('#rate_per_jam').val(0);
		@endif
	});
</script>
@endpush
{{-- $('select#jenis').on('change', function(){
var jenis = $(this).val();
if(jenis){
if(jenis == 'Operator'){
$('#rate_per_jam').parent().parent().show();
$('#insentif').parent().parent().fadeOut();
$('#operator-area').fadeIn();
$('#sopir-area').fadeOut();
}else if(jenis == 'Sopir'){
$('#rate_per_jam').parent().parent().fadeOut();
$('#insentif').parent().parent().show();
$('#operator-area').fadeOut();
$('#sopir-area').fadeIn();
}else{
$('#rate_per_jam').parent().parent().fadeOut();
$('#insentif').parent().parent().fadeOut();
$('#operator-area').fadeOut();
$('#sopir-area').fadeOut();
}
$('#rate_per_jam').val(0);
$('#insentif').val(0);
}else{
alert('Pilih salah satu jenis karyawan terlebih dahulu!!!');
}
});
$('#rate_per_jam').parent().parent().fadeOut();
$('#insentif').parent().parent().fadeOut();
$('#rate_per_jam').val(0);
$('#insentif').val(0);
$('#tombol-tambah-ot').on('click',function(e){
e.preventDefault();
var templateOt = '<div id="operator-tambahan-item"><div class="form-group"><label for="nama_overtime" class="col-lg-2 control-label">Nama Overtime</label><div class="col-sm-6"><input name="nama_overtime[]" type="text" class="form-control" id="nama_overtime" placeholder="Nama Overtime" value=""></div></div><div class="form-group"><label for="rate_overtime" class="col-lg-2 control-label">Rate Overtime</label><div class="col-sm-6"><input name="rate_overtime[]" type="number" class="form-control" id="rate_overtime" placeholder="Rate Overtime" value=""></div></div><div class="form-group"><label for="" class="col-lg-2 control-label"></label><div class="col-sm-6"><a href="#" class="tombol-hapus-ot btn btn-danger btn-flat">Hapus</a></div></div></div>';
$('#operator-tambahan').append(templateOt);
initHapusOtEvent();
});

function initHapusOtEvent() {
$('.tombol-hapus-ot').on('click', function(e){
e.preventDefault();
$(this).parent().parent().parent().remove();
});
}

$('#tombol-tambah-insentif').on('click',function(e){
e.preventDefault();
var templateInsentif = '<div id="operator-tambahan-item"><div class="form-group"><label for="nama_insentif" class="col-lg-2 control-label">Nama Insentif</label><div class="col-sm-6"><input name="nama_insentif[]" type="text" class="form-control" id="nama_insentif" placeholder="Nama Insentif" value=""></div></div>	<div class="form-group"><label for="insentif" class="col-lg-2 control-label">Insentif</label><div class="col-sm-6"><input name="insentif[]" type="number" class="form-control" id="insentif" placeholder="Insentif" value=""></div></div>	<div class="form-group"><label for="lembur" class="col-lg-2 control-label">Lembur</label><div class="col-sm-6"><input name="lembur[]" type="number" class="form-control" id="lembur" placeholder="Lembur" value=""></div></div><div class="form-group"><label for="" class="col-lg-2 control-label"></label><div class="col-sm-6"><a href="#" class="tombol-hapus-insentif btn btn-danger btn-flat">Hapus</a></div></div></div>';
$('#sopir-tambahan').append(templateInsentif);
initHapusInsentifEvent();
});

function initHapusInsentifEvent() {
$('.tombol-hapus-insentif').on('click', function(e){
e.preventDefault();
$(this).parent().parent().parent().remove();
});
}
$('#operator-area').hide();
$('#sopir-area').hide();
initHapusOtEvent();
initHapusInsentifEvent(); --}}
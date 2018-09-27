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
@include('input_number',['value'=>$d->rate_lembur,'id'=>'rate_lembur','label'=>'Rate Lembur'])
@include('select',['id'=>'jenis','label'=>'Jenis Karyawan','selectData'=>$listJenis,'selected'=>$d->jenis])
@include('input_number',['value'=>$d->rate_per_jam,'id'=>'rate_per_jam','label'=>'Rate Per Jam'])
@include('input_number',['value'=>$d->insentif,'id'=>'insentif','label'=>'Insentif'])
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
@extends('create-form')
@section('form')
@method('PUT')
@include('input',['id'=>'no','label'=>'No','value'=>$d->no])
@include('datepicker',['id'=>'tanggal','label'=>'Tanggal','value'=>$tanggal])
@include('select2-no-tags',['id'=>'id_vendor','label'=>'Pilih Vendor','selectData'=>$listVendor,'selected'=>$d->id_vendor])
<div class="form-group">
  <label for="" class="col-md-2 control-label"></label>
  <div class="col-md-6">
    Atau
  </div>
</div>
@include('input',['id'=>'vendor_baru','label'=>'Vendor Baru'])
@include('select2-no-tags',['id'=>'id_karyawan','label'=>'Pilih Pelaksana','selectData'=>$listPelaksana,'selected'=>$d->id_karyawan])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','value'=>$d->deskripsi])
@include('input_number',['id'=>'nominal','label'=>'Nominal','value'=>$d->nominal])
<div class="form-group">
	<label class="col-lg-2 control-label">Metode Pembayaran</label>
	<div class="col-sm-6">
		@include('iradio',['checked'=>$d->metode_pembayaran == 'Tunai','id'=>'metode_pembayaran','label'=>'Tunai','value'=>'Tunai'])
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		@include('iradio',['checked'=>$d->metode_pembayaran == 'Transfer','id'=>'metode_pembayaran','label'=>'Transfer','value'=>'Transfer'])
	</div>
</div>
@include('select2-no-tags',['id'=>'id_proyek','label'=>'Pilih Proyek','selectData'=>$listProyek,'selected'=>$d->id_proyek])
@include('select2-no-tags',['id'=>'id_kategori','label'=>'Pilih Kategori','selectData'=>$listKategori,'selected'=>$d->id_kategori])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<button id="cek-sub" class="btn btn-primary btn-flat">
			Cek Sub Kategori
		</button>
	</div>
</div>
@include('select2-no-tags',['id'=>'id_sub_kategori','label'=>'Pilih Sub Kategori','selectData'=>$subs,'selected'=>$d->id_sub_kategori])
@include('input',['id'=>'ref','label'=>'Ref','value'=>$d->ref])
@include('input_image',['id'=>'kwitansi','label'=>'Scan Kwitansi'])
@endsection

@include('import-datepicker')
@include('import-select2')
@include('import-icheck')
@push('script')
<script>
	$(document).ready(function(){
		$('#tambah-pajak').on('click', function(e){
			e.preventDefault();
			var pajakBaruHtml = '<div id="pajak-baru">'+$('#template-pajak').html()+$('#template-hapus').html()+'</div>';
			$('#pajak-baru-view').append(pajakBaruHtml);
		});
		$('#cek-sub').on('click', function(e){
			e.preventDefault();
			$.ajax({
				url : '{{ url('/api/sub-kategori') }}?kategori='+$('#id_kategori').val(),
				success : function(response,status){
					var optHtml = "";
					if(response.length <= 0){
						optHtml = '<option>Tidak ada sub</option>';
					}else{
						for (var i = 0; i < response.length; i++) {
							optHtml += '<option value="'+response[i].id+'">['+response[i].id+']'+response[i].nama+'</option>';
						}
					}
					$('#id_sub_kategori').html(optHtml);
				}
			})
		});
	});
	@if(count($errors->all()) > 0)
	$.ajax({
		url : '{{ url('/api/sub-kategori') }}?kategori={{ old('id_klien') }}',
		success : function(response,status){
			var optHtml = "";
			if(response.length <= 0){
				optHtml = '<option value="">Tidak ada pekerjaan</option>';
			}else{
				for (var i = 0; i < response.length; i++) {
					optHtml += '<option value="'+response[i].id+'">['+response[i].id+']'+response[i].nama+'</option>';
				}
			}
			$('#id_sub_kategori').html(optHtml);
			$('#id_sub_kategori').val('{{ old('id_proyek') }}');
		}
	})
	@endif
</script>
@endpush
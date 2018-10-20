@extends('create-form')
@section('form')
@method('PUT')
@include('datepicker',['id'=>'tanggal','label'=>'Tanggal','value'=>$tanggal])
@include('select',['id'=>'id_klien','label'=>'Pilih Klien','selectData'=>$listKlien,'selected'=>$d->id_klien])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<button id="cek-proyek" class="btn btn-primary btn-flat">
			Cek Proyek
		</button>
	</div>
</div>
@include('select',['id'=>'id_proyek','label'=>'Pilih Pekerjaan','selectData'=>$listProyek,'selected'=>$d->id_proyek])
@include('input_number',['id'=>'total_tagihan','label'=>'Total Tagihan','value'=>$d->total_tagihan])
@include('input_number',['id'=>'terbayar','label'=>'Terbayar','value'=>$d->terbayar])
@include('input_number',['id'=>'tertagih','label'=>'Tertagih','value'=>$d->tertagih])
@include('select',['id'=>'id_rekening','label'=>'Pilih Detail Bank Account','selectData'=>$listRekening,'selected'=>$d->id_rekening])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','value'=>$d->deskripsi])
<hr>
@if(count($errors->all()) > 0)
@foreach(old('nama_pajak') as $namaPajak)
@if($loop->index == 0)
<div id="template-pajak">
	@include('input',['id'=>'nama_pajak','label'=>'Nama Pajak','name'=>'nama_pajak[]', 'index'=>$loop->index])
	@include('input_number',['id'=>'pajak','label'=>'Pajak','name'=>'pajak[]', 'index'=>$loop->index])
	@include('input_number',['id'=>'nilai_pajak','label'=>'Pajak','name'=>'nilai_pajak[]', 'index'=>$loop->index])
</div>
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<button id="tambah-pajak" class="btn btn-primary btn-flat">
			Tambah Pajak
		</button>
	</div>
</div>
@else
<div id="pajak-baru">
	@include('input',['id'=>'nama_pajak','label'=>'Nama Pajak','name'=>'nama_pajak[]', 'index'=>$loop->index])
	@include('input_number',['id'=>'pajak','label'=>'Pajak','name'=>'pajak[]', 'index'=>$loop->index])
	@include('input_number',['id'=>'nilai_pajak','label'=>'Pajak','name'=>'nilai_pajak[]', 'index'=>$loop->index])
	<div class="form-group">
		<label class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<button onclick="hapusPajak(this, event)" class="btn btn-danger btn-flat">
				Hapus Pajak
			</button>
		</div>
	</div>
</div>
@endif
@endforeach
@else
<div id="template-pajak">
	@include('input',['id'=>'nama_pajak','label'=>'Nama Pajak','name'=>'nama_pajak[]','value'=>count($d->pajak) > 0 ? $d->pajak[0]->nama : ''])
	@include('input_number',['id'=>'pajak','label'=>'Pajak','name'=>'pajak[]','value'=>count($d->pajak) > 0 ? $d->pajak[0]->pajak : ''])
	@include('input_number',['id'=>'nilai_pajak','label'=>'Nilai Pajak','name'=>'nilai_pajak[]','value'=>count($d->pajak) > 0 ? $d->pajak[0]->nilai_pajak : ''])
</div>
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<button id="tambah-pajak" class="btn btn-primary btn-flat">
			Tambah Pajak
		</button>
	</div>
</div>
@endif
<div id="template-hapus" style="display: none;">
	<div class="form-group">
		<label class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<button onclick="hapusPajak(this, event)" class="btn btn-danger btn-flat">
				Hapus Pajak
			</button>
		</div>
	</div>
</div>
<div id="pajak-baru-view">
	@if(count($d->pajak) > 1)
	@foreach($d->pajak as $p)
	@if($loop->index > 0)
	<div id="pajak-baru">
		@include('input',['id'=>'nama_pajak','label'=>'Nama Pajak','name'=>'nama_pajak[]','value'=>$p->nama])
		@include('input_number',['id'=>'pajak','label'=>'Pajak','name'=>'pajak[]','value'=>$p->pajak])
		@include('input_number',['id'=>'nilai_pajak','label'=>'Nilai Pajak','name'=>'nilai_pajak[]','value'=>$p->nilai_pajak])
		<div class="form-group">
			<label class="col-lg-2 control-label"></label>
			<div class="col-sm-6">
				<button onclick="hapusPajak(this, event)" class="btn btn-danger btn-flat">
					Hapus Pajak
				</button>
			</div>
		</div>
	</div>
	@endif
	@endforeach
	@endif
</div>
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<button onclick="hitungJumlahTagihan(event)" class="btn btn-primary btn-flat">
			Hitung
		</button>
	</div>
</div>
@include('input',['id'=>'jumlah_tagihan','label'=>'Jumlah Tagihan','readonly'=>true,'value'=>$d->jumlah_tagihan])
@endsection

@include('import-datepicker')
@include('import-select2')
@push('script')
<script>
	$(document).ready(function(){
		$('#tambah-pajak').on('click', function(e){
			e.preventDefault();
			var pajakBaruHtml = '<div id="pajak-baru">'+$('#template-pajak').html()+$('#template-hapus').html()+'</div>';
			$('#pajak-baru-view').append(pajakBaruHtml);
		});
		$('#cek-proyek').on('click', function(e){
			e.preventDefault();
			$.ajax({
				url : '{{ url('/api/proyek') }}?klien='+$('#id_klien').val(),
				success : function(response,status){
					var optHtml = "";
					if(response.length <= 0){
						optHtml = '<option>Tidak ada pekerjaan</option>';
					}else{
						for (var i = 0; i < response.length; i++) {
							optHtml += '<option value="'+response[i].id+'">['+response[i].id+']'+response[i].nama+'</option>';
						}
					}
					$('#id_proyek').html(optHtml);
				}
			})
		});
	});
	function hapusPajak(el, e) {
		e.preventDefault();
		$(el).parents('#pajak-baru').remove();
	}
	@if(count($errors->all()) > 0)
	$.ajax({
		url : '{{ url('/api/proyek') }}?klien={{ old('id_klien') }}',
		success : function(response,status){
			var optHtml = "";
			if(response.length <= 0){
				optHtml = '<option>Tidak ada pekerjaan</option>';
			}else{
				for (var i = 0; i < response.length; i++) {
					optHtml += '<option value="'+response[i].id+'">['+response[i].id+']'+response[i].nama+'</option>';
				}
			}
			$('#id_proyek').html(optHtml);
			$('#id_proyek').val('{{ old('id_proyek') }}');
		}
	})
	@endif
	function hitungJumlahTagihan(event) {
		event.preventDefault();
		var total = 0;
		var tertagih = Number($('#tertagih').val());
		$('[name="pajak[]"]').each(function(item){
			var nilaiPajakInput = $(this).parent().parent().next().find('input');
			var nilaiPajak = tertagih * Number($(this).val()) / 100;
			nilaiPajakInput.val(nilaiPajak);
			total += nilaiPajak;
		});
		$('#jumlah_tagihan').val(tertagih + total);
	}
</script>
@endpush
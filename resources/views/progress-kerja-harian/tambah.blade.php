@extends('create-form')
@section('form')
@include('datepicker',['id'=>'tanggal','label'=>'Tanggal','value'=>date('Y-m-d')])
@include('select',['id'=>'id_proyek','label'=>'Pilih Proyek','selectData'=>$listProyek])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="cek-tugas-button" class="btn btn-primary btn-flat">Cek Tugas</a>
	</div>
</div>
@include('select',['id'=>'id_tugas','label'=>'Pilih Tugas','selectData'=>[]])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="cek-material-button" class="btn btn-primary btn-flat">Cek Material & Qty</a>
	</div>
</div>
@include('input',['id'=>'material','label'=>'Material','readonly'=>true])
@include('input',['id'=>'qty','label'=>'Qty','readonly'=>true])
@include('input_number',['id'=>'ritase','label'=>'Ritase'])
@include('select',['id'=>'cuaca','label'=>'Pilih Cuaca','selectData'=>$listCuaca])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi'])
@include('textarea',['id'=>'kendala','label'=>'Kendala'])
@endsection

@include('import-datepicker')
@include('import-select2')
@push('script')
<script>
	$('#cek-tugas-button').on('click', function(e){
		e.preventDefault();
		var proyek = $('#id_proyek').val();
		$.ajax({
			url : '{{ url('tugas-select') }}?proyek='+proyek,
			success : function(response, status) {
				$('#id_tugas').html(response);
			}
		})
	});
	$('#cek-material-button').on('click', function(e){
		e.preventDefault();
		var tugas = $('#id_tugas').val();
		$.ajax({
			url : '{{ url('tugas-detail') }}?id='+tugas,
			success : function(response, status) {
				$('#material').val(response.material);
				$('#qty').val(response.qty);
			}
		})
	});
	function initHapusPic(){
		$('#hapus-pic-button').on('click', function(e){
			$(this).parents('.pic-tambahan-view').remove();
			initHapusPic();
		});
	}
	initHapusPic();
</script>
@endpush
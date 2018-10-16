@extends('create-form')
@section('form')
@include('datepicker',['id'=>'tanggal','label'=>'Tanggal','value'=>date('d-m-Y')])
@include('select2-no-tags',['id'=>'id_proyek','label'=>'Pilih Proyek','selectData'=>$listProyek])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="cek-tugas-button" class="btn btn-primary btn-flat">Cek Tugas</a>
	</div>
</div>
@include('select2-no-tags',['id'=>'id_tugas','label'=>'Pilih Tugas','selectData'=>[]])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="cek-material-button" class="btn btn-primary btn-flat">Cek Material & Qty</a>
	</div>
</div>
@include('input',['id'=>'material','label'=>'Material','readonly'=>true])
@include('input',['id'=>'qty','label'=>'Qty','readonly'=>true])
@include('input_number',['id'=>'ritase','label'=>'Ritase','value'=>0])
@include('input_number',['id'=>'qty2','label'=>'Qty','value'=>0])
@include('select2-no-tags',['id'=>'cuaca','label'=>'Pilih Cuaca','selectData'=>$listCuaca])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','value'=>'-'])
@include('textarea',['id'=>'kendala','label'=>'Kendala','value'=>'-'])
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
				var $parent = $('#id_tugas').parent();
				$('#id_tugas').select2('destroy');
				// $('#id_tugas').remove();
				// $parent.append('<select id="id_tugas" class="form-control"></select>');
				$('#id_tugas').html(response);
				$('#id_tugas').select2();
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
</script>
@endpush
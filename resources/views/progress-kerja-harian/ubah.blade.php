@extends('create-form')
@section('form')
@method('PUT')
@include('datepicker',['id'=>'tanggal','label'=>'Tanggal','value'=>$tanggal])
@include('select2-no-tags',['id'=>'id_proyek','label'=>'Pilih Proyek','selectData'=>$listProyek,'selected'=>$d->id_proyek])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="cek-tugas-button" class="btn btn-primary btn-flat">Cek Tugas</a>
	</div>
</div>
@include('select',['id'=>'id_tugas','label'=>'Pilih Tugas','selectData'=>$listTugas,'selected'=>$d->id_tugas])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="cek-material-button" class="btn btn-primary btn-flat">Cek Material & Qty</a>
	</div>
</div>
@include('input',['id'=>'material','label'=>'Material','readonly'=>true,'value'=>$d->tugas->material])
@include('input',['id'=>'qty','label'=>'Qty','readonly'=>true,'value'=>$d->tugas->qty])
@include('input_number',['id'=>'ritase','label'=>'Ritase','value'=>$d->ritase])
@include('input_number',['id'=>'qty2','label'=>'Qty','value'=>$d->qty])
@include('select2-no-tags',['id'=>'cuaca','label'=>'Pilih Cuaca','selectData'=>$listCuaca,'selected'=>$d->cuaca])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','value'=>$d->deskripsi])
@include('textarea',['id'=>'kendala','label'=>'Kendala','value'=>$d->kendala])
@foreach ($d->foto as $f)
<div class="form-group">
  <label for="attach_foto" class="col-lg-2 control-label">Attach Foto</label>
  <div class="col-sm-6">
  	<a target="_blank" href="{{$f->url}}">
    <img style="max-width: 300px;" src="{{$f->url}}" alt="Attach Foto ke {{$loop->iteration}}">
    </a>
    <br>
    <a href="#" onclick="hapusYangSudahAda(event, this,{{$f->id}})" class="btn btn-danger btn-flat">Hapus Foto</a>
  </div>
</div>
@endforeach
<div id="siap-dihapus"></div>
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="attach-foto-button" class="btn btn-primary btn-flat">Tambah Attach Foto</a>
	</div>
</div>
<div id="attach-foto-area"></div>
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
	$('#attach-foto-button').on('click', function(e){
        e.preventDefault();
        $('#attach-foto-area').append('<div class="form-group"><label for="attach" class="col-lg-2 control-label">Attach Foto</label><div class="col-sm-6"><input  name="attach[]" type="file" accept="image/*" class="form-control" id="attach" placeholder="Attach Foto" value=""><br><a href="#" onclick="hapusAttach(event,this)" class="btn btn-danger btn-flat">Hapus</a></div></div>');
    });
    function hapusAttach(e,el) {
        e.preventDefault();
        $(el).parent().parent().remove();
    }
    function hapusYangSudahAda(e,el,id) {
    	e.preventDefault();
    	$(el).parent().parent().remove();
    	$('#siap-dihapus').append('<input type="hidden" name="siap_dihapus[]" value="'+id+'">');
    }
</script>
@endpush
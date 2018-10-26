@extends('create-form')
@section('form')
@include('input',['id'=>'nama_perusahaan','label'=>'Nama Perusahaan'])
@include('textarea',['id'=>'alamat','label'=>'Alamat'])

@if(count($errors->all()) <= 0)
<div id="pic-detail">
	<hr>
	@include('select',['name'=>'tipe[]','id'=>'tipe','label'=>'Pilih Jenis','selectData'=>[['value'=>'ibu','text'=>'Ibu'],['value'=>'bapak','text'=>'Bapak'],]])
	@include('input',['name'=>'nama[]','id'=>'nama','label'=>'Nama PIC'])
	@include('input',['name'=>'jabatan[]','id'=>'jabatan','label'=>'Jabatan'])
	@include('input',['name'=>'no_hp[]','id'=>'no_hp','label'=>'No HP'])
</div>

@else

@foreach(old('tipe') as $tipe)
@if($loop->index == 0) 
<div id="pic-detail"> 
	@else
	<div class="pic-tambahan-view">
		@endif
		<hr>
		@include('select',['index'=>$loop->index,'name'=>'tipe[]','id'=>'tipe','label'=>'Pilih Jenis','selectData'=>[['value'=>'ibu','text'=>'Ibu'],['value'=>'bapak','text'=>'Bapak'],]])
		@include('input',['index'=>$loop->index,'name'=>'nama[]','id'=>'nama','label'=>'Nama PIC'])
		@include('input',['index'=>$loop->index,'name'=>'jabatan[]','id'=>'jabatan','label'=>'Jabatan'])
		@include('input',['index'=>$loop->index,'name'=>'no_hp[]','id'=>'no_hp','label'=>'No HP'])
		@if($loop->index == 0)
	</div> 
	@else
	<div class="form-group">
		<label class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<a href="#" id="hapus-pic-button" class="btn btn-danger btn-flat">Hapus PIC</a>
		</div>
	</div>
</div>
@endif
@endforeach
@endif
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<a href="#" id="tambah-pic-button" class="btn btn-primary btn-flat">Tambah PIC</a>
	</div>
</div>
<div id="pic-tambahan">

</div>
@endsection
@push('script')
<script>
	$('#tambah-pic-button').on('click', function(e){
		e.preventDefault();
		var deleteButton = '<div class="form-group">'+
		'<label class="col-lg-2 control-label"></label>'+
		'<div class="col-sm-6">'+
		'<a href="#" id="hapus-pic-button" class="btn btn-danger btn-flat">Hapus PIC</a>'+
		'</div>'+
		'</div>';
		$('#pic-tambahan').append('<div class="pic-tambahan-view">'+$('#pic-detail').html()+deleteButton+'</div>');
		initHapusPic();
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
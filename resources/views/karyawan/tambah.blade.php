@extends('create-form')
@section('form')
@include('input_number',['id'=>'nik','label'=>'NIK'])
@include('input',['id'=>'nama','label'=>'Nama'])
@include('textarea',['id'=>'alamat','label'=>'Alamat'])
@include('input_number',['id'=>'no_rek','label'=>'No Rekening'])
@include('input',['id'=>'atas_nama','label'=>'Atas Nama'])
@include('input',['id'=>'no_hp','label'=>'No HP'])
@include('input',['id'=>'no_darurat','label'=>'No Darurat'])
@include('input',['id'=>'jabatan','label'=>'Jabatan'])
@include('input',['id'=>'armada','label'=>'Armada'])
@include('input_number',['id'=>'gaji_pokok','label'=>'Gaji Pokok'])
@include('input_number',['id'=>'um_harian','label'=>'UM Harian'])
{{-- @include('input_number',['id'=>'rate_lembur','label'=>'Rate Lembur']) --}}
@include('select',['id'=>'jenis','label'=>'Jenis Karyawan','selectData'=>$listJenis])
@include('input_number',['id'=>'rate_per_jam','label'=>'Rate Per Jam'])
@if(count($errors->all()) > 0)
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
@endif
{{-- @include('input_number',['id'=>'insentif','label'=>'Insentif']) --}}
@endsection

@include('karyawan.script')
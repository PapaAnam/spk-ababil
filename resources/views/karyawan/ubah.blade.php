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
	@if (count($d->overtime) > 1)
	<input type="hidden" name="id_overtime[]" value="{{$d->overtime[0]->id}}">
	@endif
	@include('input',['id'=>'nama_overtime','name'=>'nama_overtime[]','label'=>'Nama Overtime','value'=>count($d->overtime) > 1 ? $d->overtime[0]->nama : ''])
	@include('input_number',['id'=>'rate_overtime','name'=>'rate_overtime[]','label'=>'Rate Overtime','value'=>count($d->overtime) > 1 ? $d->overtime[0]->rate_overtime : ''])
	<div class="form-group">
		<label for="" class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<a href="#" id="tombol-tambah-ot" class="btn btn-primary btn-flat">Tambah OT</a>
		</div>
	</div>
	<div id="operator-tambahan">
		@if (count($d->overtime) > 1)
		@foreach ($d->overtime as $ins)
		@if($loop->index > 0)
		<div id="operator-tambahan-item">
			<input type="hidden" name="id_overtime[]" value="{{$d->overtime[$loop->index]->id}}">
			@include('input',['id'=>'nama_overtime','name'=>'nama_overtime[]','label'=>'Nama Overtime','value'=>$d->overtime[$loop->index]->nama])
			@include('input_number',['id'=>'rate_overtime','name'=>'rate_overtime[]','label'=>'Rate Overtime','value'=>$d->overtime[$loop->index]->rate_overtime])
			<div class="form-group"><label for="" class="col-lg-2 control-label"></label><div class="col-sm-6"><a href="#" class="tombol-hapus-ot btn btn-danger btn-flat">Hapus</a></div></div>
		</div>
		@endif
		@endforeach
		@endif
	</div>
</div>
<div id="sopir-area">
	@if (count($d->insentifdetail) > 1)
	<input type="hidden" name="id_insentif[]" value="{{$d->insentifdetail[0]->id}}">
	@endif
	@include('input',['id'=>'nama_insentif','name'=>'nama_insentif[]','label'=>'Nama Insentif','value'=>count($d->insentifdetail) > 1 ? $d->insentifdetail[0]->nama : ''])
	@include('input_number',['id'=>'insentif','name'=>'insentif[]','label'=>'Insentif','value'=>count($d->insentifdetail) > 1 ? $d->insentifdetail[0]->insentif : ''])
	@include('input_number',['id'=>'lembur','name'=>'lembur[]','label'=>'Lembur','value'=>count($d->insentifdetail) > 1 ? $d->insentifdetail[0]->lembur : ''])
	<div class="form-group">
		<label for="" class="col-lg-2 control-label"></label>
		<div class="col-sm-6">
			<a href="#" id="tombol-tambah-insentif" class="btn btn-primary btn-flat">Tambah Insentif</a>
		</div>
	</div>
	<div id="sopir-tambahan">
		@if (count($d->insentifdetail) > 1)
		@foreach ($d->insentifdetail as $ins)
		@if($loop->index > 0)
		<div id="sopir-tambahan-item">
			<input type="hidden" name="id_insentif[]" value="{{$d->insentifdetail[$loop->index]->id}}">
			@include('input',['id'=>'nama_insentif','name'=>'nama_insentif[]','label'=>'Nama Insentif','value'=>count($d->insentifdetail) > 1 ? $d->insentifdetail[$loop->index]->nama : ''])
			@include('input_number',['id'=>'insentif','name'=>'insentif[]','label'=>'Insentif','value'=>count($d->insentifdetail) > 1 ? $d->insentifdetail[$loop->index]->insentif : ''])
			@include('input_number',['id'=>'lembur','name'=>'lembur[]','label'=>'Lembur','value'=>count($d->insentifdetail) > 1 ? $d->insentifdetail[$loop->index]->lembur : ''])
			<div class="form-group"><label for="" class="col-lg-2 control-label"></label><div class="col-sm-6"><a href="#" class="tombol-hapus-insentif btn btn-danger btn-flat">Hapus</a></div></div>
		</div>
		@endif
		@endforeach
		@endif
	</div>
</div>
@endif
{{-- @include('input_number',['value'=>$d->rate_per_jam,'id'=>'rate_per_jam','label'=>'Rate Per Jam']) --}}
{{-- @include('input_number',['value'=>$d->insentif,'id'=>'insentif','label'=>'Insentif']) --}}
@endsection

@include('karyawan.script-ubah')
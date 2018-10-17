@extends('create-form')
@section('form')
@include('input',['id'=>'nama_unit','label'=>'Nama Unit'])
@include('input',['id'=>'plat_no','label'=>'Plat No'])
@include('input',['id'=>'merk','label'=>'Merk'])
{{-- @include('input',['id'=>'model','label'=>'Model'])
@include('input',['id'=>'seri','label'=>'Seri'])
@include('input_number',['id'=>'tahun','label'=>'Tahun'])
@include('input',['id'=>'warna','label'=>'Warna']) --}}
@include('input',['id'=>'km_per_jam','label'=>'Km/jam'])
@include('select2-no-tags',['id'=>'id_vendor','label'=>'Pilih Vendor','selectData'=>$listVendor])
<div class="form-group">
  <label for="" class="col-md-2 control-label"></label>
  <div class="col-md-6">
    Atau
  </div>
</div>
@include('input',['id'=>'vendor_baru','label'=>'Vendor Baru'])
@include('select2-no-tags',['id'=>'id_kategori','label'=>'Pilih Kategori','selectData'=>$listKategori])
<div class="form-group">
  <label for="" class="col-md-2 control-label"></label>
  <div class="col-md-6">
    Atau
  </div>
</div>
@include('input',['id'=>'kategori_baru','label'=>'Kategori Baru'])
<div class="alert alert-info">
  Jika isi vendor atau isi kategori ada valuenya maka lebih diprioritaskan
</div>
@include('datepicker',['id'=>'mulai','label'=>'Mulai'])
@include('datepicker',['id'=>'selesai','label'=>'Selesai'])
@endsection

@include('import-select2')
@include('import-datepicker')
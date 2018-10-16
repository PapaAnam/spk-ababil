@extends('create-form')
@section('form')
@method('PUT')
@include('input',['id'=>'nama','value'=>$d->nama,'label'=>'Nama'])
@include('input',['id'=>'plat_no','value'=>$d->plat_no,'label'=>'Plat No'])
@include('input',['id'=>'merk','value'=>$d->merk,'label'=>'Merk'])
@include('input',['id'=>'model','value'=>$d->model,'label'=>'Model'])
@include('input',['id'=>'seri','value'=>$d->seri,'label'=>'Seri'])
@include('input_number',['id'=>'tahun','value'=>$d->tahun,'label'=>'Tahun'])
@include('input',['id'=>'warna','value'=>$d->warna,'label'=>'Warna'])
@include('input',['id'=>'km_per_jam','value'=>$d->km_per_jam,'label'=>'Km/jam'])
@include('select2-no-tags',['id'=>'id_vendor','label'=>'Pilih Vendor','selectData'=>$listVendor,'selected'=>$d->id_vendor])
<div class="form-group">
  <label for="" class="col-md-2 control-label"></label>
  <div class="col-md-6">
    Atau
  </div>
</div>
@include('input',['id'=>'vendor_baru','label'=>'Vendor Baru'])
@include('select2-no-tags',['id'=>'id_kategori','label'=>'Pilih Kategori','selectData'=>$listKategori,'selected'=>$d->id_kategori])
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
@endsection

@include('import-select2')
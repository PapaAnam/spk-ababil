@extends('my-view')
@section('other-box')
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lihat berdasarkan rentang waktu</h3>
      </div>
      <div class="box-body">
        <form method="get" action="" class="form-horizontal">
          @include('datepicker', ['size'=>10, 'id'=>'dari','label'=>'Dari','required'=>true,'value'=>request()->query('dari')])
          @include('datepicker', ['size'=>10, 'id'=>'sampai','label'=>'Sampai','required'=>true,'value'=>request()->query('sampai')])
          <div class="form-group">
            <label class="col-lg-2 control-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary btn-flat">Lihat</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lihat berdasarkan Kategori</h3>
      </div>
      <div class="box-body">
        <form method="get" action="" class="form-horizontal">
          @include('select',['size'=>[3, 9],'id'=>'kategori','label'=>'Pilih Kategori','selectData'=>$listKategori,'selected'=>request()->query('kategori')])
          <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary btn-flat">Lihat</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lihat berdasarkan Vendor</h3>
      </div>
      <div class="box-body">
        <form method="get" action="" class="form-horizontal">
          @include('select',['size'=>[3, 9],'id'=>'vendor','label'=>'Pilih Vendor','selectData'=>$listVendor,'selected'=>request()->query('vendor')])
          <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary btn-flat">Lihat</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lihat berdasarkan Pelaksana</h3>
      </div>
      <div class="box-body">
        <form method="get" action="" class="form-horizontal">
          @include('select',['size'=>[3, 9],'id'=>'pelaksana','label'=>'Pilih Pelaksana','selectData'=>$listPelaksana,'selected'=>request()->query('pelaksana')])
          <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary btn-flat">Lihat</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lihat berdasarkan Proyek</h3>
      </div>
      <div class="box-body">
        <form method="get" action="" class="form-horizontal">
          @include('select',['size'=>[3, 9],'id'=>'proyek','label'=>'Pilih Proyek','selectData'=>$listProyek,'selected'=>request()->query('proyek')])
          <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary btn-flat">Lihat</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>No</th>
    <th>Tanggal</th>
    <th>Vendor</th>
    <th>Pelaksana</th>
    <th>Nominal</th>
    <th>Proyek</th>
    <th>Kategori</th>
    <th>Deskripsi</th>
    <th>Ref</th>
    <th>Kwitansi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>No</th>
    <th>Tanggal</th>
    <th>Vendor</th>
    <th>Pelaksana</th>
    <th>Nominal</th>
    <th>Proyek</th>
    <th>Kategori</th>
    <th>Deskripsi</th>
    <th>Ref</th>
    <th>Kwitansi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->no }}</td>
    <td>{{ $d->tanggal }}</td>
    <td>{{ $d->vendor->nama }}</td>
    <td>{{ $d->pelaksana->nama }}</td>
    <td>{{ $d->nominal }}</td>
    <td>{{ $d->proyek->nama }}</td>
    <td>
      {{ $d->kategori->nama }} <br>
      {{ $d->subkategori ? $d->subkategori->nama : '' }}
    </td>
    <td>{{ $d->deskripsi }}</td>
    <td>{{ $d->ref }}</td>
    <td><a href="{{ $d->kwitansi }}" target="_blank">Lihat</a></td>
  </tr>
  @endforeach
</tbody>
@endsection

@include('import-datepicker')
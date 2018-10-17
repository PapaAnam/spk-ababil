@extends('my-view')

@section('other-box')

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Lihat berdasarkan rentang waktu</h3>
  </div>
  <div class="box-body">
    <form method="get" action="" class="form-horizontal">
      @include('datepicker', ['id'=>'dari','label'=>'Dari','required'=>true,'value'=>request()->query('dari')])
      @include('datepicker', ['id'=>'sampai','label'=>'Sampai','required'=>true,'value'=>request()->query('sampai')])
      <div class="form-group">
        <label class="col-lg-2 control-label"></label>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-primary btn-flat">Lihat</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Qty Masuk</th>
    <th>Qty Keluar</th>
    <th>Pelaksana</th>
    <th>Armada</th>
    <th>Proyek</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Qty Masuk</th>
    <th>Qty Keluar</th>
    <th>Pelaksana</th>
    <th>Armada</th>
    <th>Proyek</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d) 
  <tr>
    <td>{{$d->id}}</td>
    <td>{{tglIndo($d->tanggal_masuk)}}</td>
    <td>{{$d->qty_masuk}}</td>
    <td>{{$d->qty_keluar}}</td>
    <td>{{$d->pelaksana ? $d->pelaksana->nama : ''}}</td>
    <td>{{$d->armada ? $d->armada->id : ''}}</td>
    <td>{{$d->proyek ? $d->proyek->nama : ''}}</td>
    <td>
      <a href="{{route('konsumsi-bbm.edit-masuk',[$d->id])}}" class="btn btn-flat btn-primary">Masuk</a>
      <a href="{{route('konsumsi-bbm.edit-keluar',[$d->id])}}" class="btn btn-flat btn-warning">Keluar</a>
      @include('delete_button', ['link' => route('konsumsi-bbm.destroy', $d->id)])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection

@section('custom-button')

<a href="{{route('konsumsi-bbm.keluar')}}" class="btn btn-flat btn-warning pull-right">BBM Keluar</a>
<a href="{{route('konsumsi-bbm.masuk')}}" class="btn btn-flat btn-primary pull-right">BBM Masuk</a>&nbsp;

@endsection

@if(count($data) > 0)

@section('bottom-box')

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <div class="box-body">
    <dl class="dl-horizontal">
      @include('line',['label'=>'Total Qty Masuk','text'=>$data->sum('qty_masuk')])
      @include('line',['label'=>'Total Qty Keluar','text'=>$data->sum('qty_keluar')])
    </dl>
  </div>
</div>

@endsection

@endif

@include('import-datepicker')
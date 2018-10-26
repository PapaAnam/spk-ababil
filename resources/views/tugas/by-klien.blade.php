@extends('my-view')
@section('other-box')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lihat berdasarkan Klien</h3>
  </div>
  <div class="box-body">
    <form method="get" action="" class="form-horizontal">
      @include('select2-no-tags',['id'=>'klien','label'=>'Pilih Klien','selectData'=>$listKlien,'selected'=>request()->query('klien')])
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

@include('tugas.table')
@include('import-select2')
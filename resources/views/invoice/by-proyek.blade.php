@extends('invoice.layout')
@section('filter')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lihat berdasarkan proyek</h3>
  </div>
  <div class="box-body">
    <form method="get" action="" class="form-horizontal">
      @include('select',['id'=>'proyek','label'=>'Pilih Proyek','selectData'=>$listProyek,'selected'=>request()->query('proyek')])
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
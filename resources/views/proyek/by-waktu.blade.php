@extends('proyek.layout')
@section('filter')
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

@include('import-datepicker')
@extends('my-view')
@section('other-box')
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Lihat berdasarkan Klien</h3>
      </div>
      <div class="box-body">
        <form method="get" action="{{url('progress/proyek')}}" class="form-horizontal">
          @include('select2-no-tags',['labelSize'=>3,'selectSize'=>8,'id'=>'klien','label'=>'Pilih Klien','selectData'=>$listKlien,'selected'=>request()->query('klien')])
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

@include('progress.proyek-table')
@include('import-select2')

@section('bottom-box')
@yield('other')
@endsection
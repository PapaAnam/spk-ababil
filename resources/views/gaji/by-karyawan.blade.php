@extends('gaji.index')
@section('filter')
<div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lihat berdasarkan Karyawan</h3>
      </div>
      <div class="box-body">
        <form method="get" action="" class="form-horizontal">
          @include('select2-no-tags',['size'=>[3, 9],'id'=>'karyawan','label'=>'Pilih Karyawan','selectData'=>$listKaryawan,'selected'=>request()->query('karyawan')])
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
@endsection

@include('import-select2')
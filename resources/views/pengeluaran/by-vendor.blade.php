@extends('pengeluaran.index')
@section('filter')
<div class="col-md-12">
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
@endsection
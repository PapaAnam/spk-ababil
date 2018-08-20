@extends('my-view')
@section('other-box')
<div class="row">
  <div class="col-md-12">
    <a href="{{ route('gaji.by-periode') }}" class="btn btn-primary btn-flat">By Periode</a>
    <a href="{{ route('gaji.by-karyawan') }}" class="btn btn-primary btn-flat">By Karyawan</a>
    <a href="{{ route('gaji.by-jabatan') }}" class="btn btn-primary btn-flat">By Jabatan</a>
  </div>
</div>
@endsection
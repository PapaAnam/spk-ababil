@extends('app.form')
@section('content')
<div class="content-wrapper">
  @include('page_header2')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @include('error_msg')
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
          </div>
          <form action="{{ $action }}" method="post" class="form-horizontal">
            @csrf
            <div class="box-body">
              @yield('form')              
            </div>
            <div class="box-footer">
              @include('batal_btn')
              @include('simpan_btn')
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
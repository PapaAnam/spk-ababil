@extends('app.form')
@section('content')
<div class="content-wrapper">
  @include('page_header2')
  <section class="content">
    <div class="row">
      @include('success_msg')
      <div class="col-md-12">
        @include('error_msg')
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            @isset($edit_url)
            <a href="<?=$edit_url?>" class="btn btn-primary btn-flat pull-right">Ubah</a>
            @endisset
          </div>
          <form action="{{ $action }}" method="post" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              @yield('form')              
            </div>
            <div class="box-footer">
              @include('batal_btn')
              @isset($saveBtn)
              @else
              @isset($simpanBtn)
              @else
              @include('simpan_btn')
              @endisset
              @endisset
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
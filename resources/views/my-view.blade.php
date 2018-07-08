@include('table.atas')
<div class="content-wrapper">
  @include('page_header')
  <section class="content">
    <div class="row">
      @include('success_msg')
      <div class="col-xs-12">
        @yield('other-box')
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
            @include('tambah_button', ['link'  => $createLink])
          </div>
          <div class="box-body">
            <table id="dt" class="table table-bordered table-striped">
              @yield('table')
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<form action="" id="form-hapus" method="post">
  @method('delete')
  @csrf
</form>
<script>
  function hapus(link, e){
    e.preventDefault();
    if(confirm('Anda yakin ? ')){
      var f = document.getElementById('form-hapus');
      f.action = link;
      f.submit();
    }
  }
</script>
@include('table.bawah')
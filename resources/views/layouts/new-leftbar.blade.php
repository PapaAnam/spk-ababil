@php
$hakakses = Auth::user()->hakakses;
if(!is_null($hakakses)){
  $_menu = json_decode($hakakses->hak_akses);
}
@endphp
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p class="text-capitalize">{{ Auth::user()->nama_lengkap }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    @if(is_null($hakakses))
    @else
    @if(isset($_menu))
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      @include('layouts.leftbar.dasbor')
      @include('layouts.leftbar.progress')
      @include('layouts.leftbar.jurnal')
      @include('layouts.leftbar.proyek')
      @include('layouts.leftbar.tugas')
      @include('layouts.leftbar.invoice')
      @include('layouts.leftbar.pengeluaran')
      @include('layouts.leftbar.karyawan')
      @include('layouts.leftbar.keuangan')
      @include('layouts.leftbar.klien')
      @include('layouts.leftbar.armada')
      @include('layouts.leftbar.setting')
    </ul>
    @endif
    @endif
  </section>
</aside>
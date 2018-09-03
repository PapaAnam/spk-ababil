<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p class="text-capitalize">{{ Auth::user()->nama_lengkap }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    {{-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form> --}}
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li @if($active == 'dasbor') class="active" @endif>
        <a href="{{ route('dasbor') }}">
          <i class="fa fa-dashboard"></i> <span>Dasbor</span>
        </a>
      </li>
      <li class="{{ $active == 'karyawan.index' ? 'active' : '' }}">
        <a href="{{ route('karyawan.index') }}">
          <i class="fa fa-users"></i> <span>Karyawan</span>
        </a>
      </li>
      <li class="{{ $active == 'time-sheet.index' ? 'active' : '' }}">
        <a href="{{ route('time-sheet.index') }}">
          <i class="fa fa-clock-o"></i> <span>Time Sheet Karyawan</span>
        </a>
      </li>
      <li class="{{ $active == 'klien.index' ? 'active' : '' }}">
        <a href="{{ route('klien.index') }}">
          <i class="fa fa-user-plus"></i> <span>Klien</span>
        </a>
      </li>
      <li class="{{ $active == 'proyek.index' ? 'active' : '' }}">
        <a href="{{ route('proyek.index') }}">
          <i class="fa fa-check-square-o"></i> <span>Proyek</span>
        </a>
      </li>
      <li class="treeview @if(in_array($active, ['tugas.by-waktu','tugas.by-klien','tugas.by-proyek'])) active @endif ">
        <a href="#">
          <i class="fa fa-cubes"></i>
          <span>Tugas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['tugas.by-waktu'])) class="active" @endif>
            <a href="{{ route('tugas.by-waktu') }}"><i class="fa fa-circle-o"></i> By Rentang Waktu</a>
          </li>
          <li @if(in_array($active, ['tugas.by-klien'])) class="active" @endif>
            <a href="{{ route('tugas.by-klien') }}"><i class="fa fa-circle-o"></i> By Klien</a>
          </li>
          <li @if(in_array($active, ['tugas.by-proyek'])) class="active" @endif>
            <a href="{{ route('tugas.by-proyek') }}"><i class="fa fa-circle-o"></i> By Proyek</a>
          </li>
        </ul>
      </li>
      @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
      <li class="{{ $active == 'progress-kerja-harian.index' ? 'active' : '' }}">
        <a href="{{ route('progress-kerja-harian.index') }}">
          <i class="fa fa-money"></i> <span>Lap. Progress Kerja Harian</span>
        </a>
      </li>
      @endif
      @if(Auth::user()->role == 'finance' || Auth::user()->role == 'superadmin')
      <li class="{{ $active == 'invoice.index' ? 'active' : '' }}">
        <a href="{{ route('invoice.index') }}">
          <i class="fa fa-print"></i> <span>Invoice</span>
        </a>
      </li>
      @endif
      @if(Auth::user()->role == 'superadmin')
      <li class="{{ $active == 'kategori.index' ? 'active' : '' }}">
        <a href="{{ route('kategori.index') }}">
          <i class="fa fa-cubes"></i> <span>Kategori Pengeluaran</span>
        </a>
      </li>
      @endif
      <li class="treeview @if(in_array($active, ['pengeluaran.by-waktu','pengeluaran.by-proyek','pengeluaran.by-kategori','pengeluaran.by-pelaksana','pengeluaran.by-vendor','pengeluaran.create',])) active @endif ">
        <a href="#">
          <i class="fa fa-paypal"></i>
          <span>Pengeluaran</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['pengeluaran.create'])) class="active" @endif>
            <a href="{{ route('pengeluaran.create') }}"><i class="fa fa-circle-o"></i> Tambah Pengeluaran</a>
          </li>
          <li @if(in_array($active, ['pengeluaran.by-waktu'])) class="active" @endif>
            <a href="{{ route('pengeluaran.by-waktu') }}"><i class="fa fa-circle-o"></i> By Rentang Waktu</a>
          </li>
          <li @if(in_array($active, ['pengeluaran.by-proyek'])) class="active" @endif>
            <a href="{{ route('pengeluaran.by-proyek') }}"><i class="fa fa-circle-o"></i> By Proyek</a>
          </li>
          <li @if(in_array($active, ['pengeluaran.by-kategori'])) class="active" @endif>
            <a href="{{ route('pengeluaran.by-kategori') }}"><i class="fa fa-circle-o"></i> By Kategori</a>
          </li>
          <li @if(in_array($active, ['pengeluaran.by-pelaksana'])) class="active" @endif>
            <a href="{{ route('pengeluaran.by-pelaksana') }}"><i class="fa fa-circle-o"></i> By Pelaksana</a>
          </li>
          <li @if(in_array($active, ['pengeluaran.by-vendor'])) class="active" @endif>
            <a href="{{ route('pengeluaran.by-vendor') }}"><i class="fa fa-circle-o"></i> By Vendor</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['gaji.index', 'gaji.create','gaji.index', 'gaji.by-karyawan','gaji.by-periode','gaji.by-jabatan'])) active @endif ">
        <a href="#">
          <i class="fa fa-dollar"></i>
          <span>Keuangan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['gaji.create'])) class="active" @endif>
            <a href="{{ route('gaji.create') }}"><i class="fa fa-circle-o"></i> Hitung Gaji</a>
          </li>
          @if(Auth::user()->role === 'superadmin')
          <li @if(in_array($active, ['gaji.index'])) class="active" @endif>
            <a href="{{ route('gaji.index') }}"><i class="fa fa-circle-o"></i> Laporan Gaji</a>
          </li>
          <li @if(in_array($active, ['gaji.by-karyawan'])) class="active" @endif>
            <a href="{{ route('gaji.by-karyawan') }}"><i class="fa fa-circle-o"></i> By Karyawan</a>
          </li>
          <li @if(in_array($active, ['gaji.by-periode'])) class="active" @endif>
            <a href="{{ route('gaji.by-periode') }}"><i class="fa fa-circle-o"></i> By Periode</a>
          </li>
          <li @if(in_array($active, ['gaji.by-jabatan'])) class="active" @endif>
            <a href="{{ route('gaji.by-jabatan') }}"><i class="fa fa-circle-o"></i> By Jabatan</a>
          </li>
          @endif
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['satuan', 'satuan.create', 'satuan.edit','rekening', 'rekening.create', 'rekening.edit', 'vendor.index', 'vendor.create','vendor.edit','uam.index', 'uam.create','uam.edit'])) active @endif ">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['uam.index', 'uam.create', 'uam.edit'])) class="active" @endif>
            <a href="{{ route('uam.index') }}"><i class="fa fa-circle-o"></i> User Account Management</a>
          </li>
          <li @if(in_array($active, ['vendor.index', 'vendor.create', 'vendor.edit'])) class="active" @endif>
            <a href="{{ route('vendor.index') }}"><i class="fa fa-circle-o"></i> Vendor</a>
          </li>
          @if(Auth::user()->role == 'superadmin')
          <li @if(in_array($active, ['satuan', 'satuan.create', 'satuan.edit'])) class="active" @endif>
            <a href="{{ route('satuan') }}"><i class="fa fa-circle-o"></i> Satuan</a>
          </li>
          @endif
          @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'finance')
          <li @if(in_array($active, ['rekening', 'rekening.create', 'rekening.edit'])) class="active" @endif>
            <a href="{{ route('rekening') }}"><i class="fa fa-circle-o"></i> Rekening</a>
          </li>
          @endif
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
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
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li @if($active == 'dasbor') class="active" @endif>
        <a href="{{ route('dasbor') }}">
          <i class="fa fa-dashboard"></i> <span>Dasbor</span>
        </a>
      </li>
      <li class="treeview @if(in_array($active, ['progress.tugas','progress.proyek'])) active @endif ">
        <a href="#">
          <i class="fa fa-check-circle-o"></i>
          <span>Progress</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['progress.tugas'])) class="active" @endif>
            <a href="{{ route('progress.tugas') }}"><i class="fa fa-circle-o"></i> Tugas</a>
          </li>
          <li @if(in_array($active, ['progress.proyek'])) class="active" @endif>
            <a href="{{ route('progress.proyek') }}"><i class="fa fa-circle-o"></i> Proyek</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['time-sheet.index','time-sheet.create','progress-kerja-harian.index','jam-alat.index','jam-alat.create','konsumsi-bbm.index','memo.index'])) active @endif ">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Jurnal</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['time-sheet.index'])) class="active" @endif>
            <a href="{{ route('time-sheet.index') }}"><i class="fa fa-circle-o"></i> Time Sheet Karyawan</a>
          </li>
          @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
          <li class="{{ $active == 'progress-kerja-harian.index' ? 'active' : '' }}">
            <a href="{{ route('progress-kerja-harian.index') }}">
              <i class="fa fa-circle-o"></i> <span>Lap. Progress Kerja Harian</span>
            </a>
          </li>
          @endif
          <li @if(in_array($active, ['konsumsi-bbm.index'])) class="active" @endif>
            <a href="{{ route('konsumsi-bbm.index') }}"><i class="fa fa-circle-o"></i> Konsumsi BBM</a>
          </li>
          <li @if(in_array($active, ['jam-alat.index'])) class="active" @endif>
            <a href="{{ route('jam-alat.index') }}"><i class="fa fa-circle-o"></i> Jam Alat</a>
          </li>
          <li @if(in_array($active, ['memo.index'])) class="active" @endif>
            <a href="{{ route('memo.index') }}"><i class="fa fa-circle-o"></i> Memo</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['proyek.by-waktu','proyek.by-klien','proyek.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-check-square-o"></i>
          <span>Proyek</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
          <li @if(in_array($active, ['proyek.create'])) class="active" @endif>
            <a href="{{ route('proyek.create') }}"><i class="fa fa-circle-o"></i> Tambah Proyek</a>
          </li>
          @endif
          <li @if(in_array($active, ['proyek.by-waktu'])) class="active" @endif>
            <a href="{{ route('proyek.by-waktu') }}"><i class="fa fa-circle-o"></i> By Rentang Waktu</a>
          </li>
          <li @if(in_array($active, ['proyek.by-klien'])) class="active" @endif>
            <a href="{{ route('proyek.by-klien') }}"><i class="fa fa-circle-o"></i> By Klien</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['tugas.by-waktu','tugas.by-klien','tugas.by-proyek','tugas.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-cubes"></i>
          <span>Tugas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
          <li @if(in_array($active, ['tugas.create'])) class="active" @endif>
            <a href="{{ route('tugas.create') }}"><i class="fa fa-circle-o"></i> Tambah Tugas</a>
          </li>
          @endif
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
      @if(Auth::user()->role == 'finance' || Auth::user()->role == 'superadmin')
      <li class="treeview @if(in_array($active, ['invoice.by-waktu','invoice.by-proyek','invoice.by-klien','invoice.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-print"></i>
          <span>Invoice</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['invoice.create'])) class="active" @endif>
            <a href="{{ route('invoice.create') }}"><i class="fa fa-circle-o"></i> Tambah Invoice</a>
          </li>
          <li @if(in_array($active, ['invoice.by-waktu'])) class="active" @endif>
            <a href="{{ route('invoice.by-waktu') }}"><i class="fa fa-circle-o"></i> By Rentang Waktu</a>
          </li>
          <li @if(in_array($active, ['invoice.by-proyek'])) class="active" @endif>
            <a href="{{ route('invoice.by-proyek') }}"><i class="fa fa-circle-o"></i> By Proyek</a>
          </li>
          <li @if(in_array($active, ['invoice.by-klien'])) class="active" @endif>
            <a href="{{ route('invoice.by-klien') }}"><i class="fa fa-circle-o"></i> By Klien</a>
          </li>
        </ul>
      </li>
      @endif
      <li class="treeview @if(in_array($active, ['pengeluaran.by-waktu','pengeluaran.by-proyek','pengeluaran.by-kategori','pengeluaran.by-pelaksana','pengeluaran.by-vendor','pengeluaran.create','kategori.index',])) active @endif ">
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
          @if(Auth::user()->role == 'superadmin')
          <li @if(in_array($active, ['kategori.index'])) class="active" @endif>
            <a href="{{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Kategori</a>
          </li>
          @endif
        </ul>
      </li>
      <li class="{{ $active == 'karyawan.index' ? 'active' : '' }}">
        <a href="{{ route('karyawan.index') }}">
          <i class="fa fa-users"></i> <span>Karyawan</span>
        </a>
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
      <li class="{{ $active == 'klien.index' ? 'active' : '' }}">
        <a href="{{ route('klien.index') }}">
          <i class="fa fa-user-plus"></i> <span>Klien</span>
        </a>
      </li>
      <li class="treeview @if(in_array($active, ['kategori-armada.index','kategori-armada.create','armada.index','armada.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-sitemap"></i>
          <span>Armada</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['armada.create'])) class="active" @endif>
            <a href="{{ route('armada.create') }}"><i class="fa fa-circle-o"></i> Tambah Armada</a>
          </li>
          <li @if(in_array($active, ['armada.index'])) class="active" @endif>
            <a href="{{ route('armada.index') }}"><i class="fa fa-circle-o"></i> Lihat Armada</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['satuan', 'satuan.create', 'satuan.edit','rekening', 'rekening.create', 'rekening.edit', 'vendor.index', 'vendor.create','vendor.edit','uam.index', 'uam.create','uam.edit','role-maker.index'])) active @endif ">
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
          <li @if(in_array($active, ['kategori-armada.index'])) class="active" @endif>
            <a href="{{ route('kategori-armada.index') }}"><i class="fa fa-circle-o"></i> Kategori Armada</a>
          </li>
          <li @if(in_array($active, ['role-maker.index'])) class="active" @endif>
            <a href="{{ route('role-maker.index') }}"><i class="fa fa-circle-o"></i> Role Maker</a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
</aside>
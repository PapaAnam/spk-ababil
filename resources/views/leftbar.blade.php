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
      <li <?= url()->current()==url('') ? "class=\"active\"" : ""?>>
        <a href="<?=url('')?>">
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
      <li class="{{ $active == 'tugas.index' ? 'active' : '' }}">
        <a href="{{ route('tugas.index') }}">
          <i class="fa fa-circle-o"></i> <span>Tugas</span>
        </a>
      </li>
      @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
      <li class="{{ $active == 'progress-kerja-harian.index' ? 'active' : '' }}">
        <a href="{{ route('progress-kerja-harian.index') }}">
          <i class="fa fa-money"></i> <span>Lap. Progress Kerja Harian</span>
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
      {{-- <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Forms</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
          <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
          <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i> <span>Tables</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
          <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
        </ul>
      </li>
      <li>
        <a href="pages/calendar.html">
          <i class="fa fa-calendar"></i> <span>Calendar</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red">3</small>
            <small class="label pull-right bg-blue">17</small>
          </span>
        </a>
      </li>
      <li>
        <a href="pages/mailbox/mailbox.html">
          <i class="fa fa-envelope"></i> <span>Mailbox</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-yellow">12</small>
            <small class="label pull-right bg-green">16</small>
            <small class="label pull-right bg-red">5</small>
          </span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Examples</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
          <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
          <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
          <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
          <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
          <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
          <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
          <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
          <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Multilevel</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          <li>
            <a href="#"><i class="fa fa-circle-o"></i> Level One
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
              <li>
                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
        </ul>
      </li>
      <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
      <li class="header">LABELS</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
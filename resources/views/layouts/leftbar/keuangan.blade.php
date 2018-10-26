@isset($_menu->keuangan)
      <li class="treeview @if(in_array($active, ['gaji.index', 'gaji.create','gaji.index', 'gaji.by-karyawan','gaji.by-periode','gaji.by-jabatan'])) active @endif ">
        <a href="#">
          <i class="fa fa-dollar"></i>
          <span>Penggajian</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @isset($_menu->keuangan_create)
          <li @if(in_array($active, ['gaji.create'])) class="active" @endif>
            <a href="{{ route('gaji.create') }}"><i class="fa fa-circle-o"></i> Hitung Gaji</a>
          </li>
          @endisset
          @isset($_menu->keuangan)
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
          @endisset
        </ul>
      </li>
      @endisset
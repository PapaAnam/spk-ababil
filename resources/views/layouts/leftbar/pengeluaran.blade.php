@isset($_menu->pengeluaran)
      <li class="treeview @if(in_array($active, ['pengeluaran.by-waktu','pengeluaran.by-proyek','pengeluaran.by-kategori','pengeluaran.by-pelaksana','pengeluaran.by-vendor','pengeluaran.create','kategori.index',])) active @endif ">
        <a href="#">
          <i class="fa fa-paypal"></i>
          <span>Pengeluaran</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @isset($_menu->pengeluaran_create)
          <li @if(in_array($active, ['pengeluaran.create'])) class="active" @endif>
            <a href="{{ route('pengeluaran.create') }}"><i class="fa fa-circle-o"></i> Tambah Pengeluaran</a>
          </li>
          @endisset
          @isset($_menu->pengeluaran)
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
          <li @if(in_array($active, ['kategori.index'])) class="active" @endif>
            <a href="{{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Kategori</a>
          </li>
          @endisset
        </ul>
      </li>
      @endisset
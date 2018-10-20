
      @isset($_menu->proyek)
      <li class="treeview @if(in_array($active, ['proyek.by-waktu','proyek.by-klien','proyek.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-check-square-o"></i>
          <span>Proyek</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @isset($_menu->proyek_create)
          <li @if(in_array($active, ['proyek.create'])) class="active" @endif>
            <a href="{{ route('proyek.create') }}"><i class="fa fa-circle-o"></i> Tambah Proyek</a>
          </li>
          @endisset
          @isset($_menu->proyek)
          <li @if(in_array($active, ['proyek.by-waktu'])) class="active" @endif>
            <a href="{{ route('proyek.by-waktu') }}"><i class="fa fa-circle-o"></i> By Rentang Waktu</a>
          </li>
          <li @if(in_array($active, ['proyek.by-klien'])) class="active" @endif>
            <a href="{{ route('proyek.by-klien') }}"><i class="fa fa-circle-o"></i> By Klien</a>
          </li>
          @endisset
        </ul>
      </li>
      @endisset
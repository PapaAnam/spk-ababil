@isset($_menu->karyawan)
      <li class="{{ $active == 'karyawan.index' ? 'active' : '' }}">
        <a href="{{ route('karyawan.index') }}">
          <i class="fa fa-users"></i> <span>Karyawan</span>
        </a>
      </li>
      @endisset
@isset($_menu->klien)
      <li class="{{ $active == 'klien.index' ? 'active' : '' }}">
        <a href="{{ route('klien.index') }}">
          <i class="fa fa-user-plus"></i> <span>Klien</span>
        </a>
      </li>
      @endisset
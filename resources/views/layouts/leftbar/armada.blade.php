@isset($_menu->armada)
      <li class="treeview @if(in_array($active, ['armada.index','armada.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-sitemap"></i>
          <span>Armada</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @isset($_menu->armada_create)
          <li @if(in_array($active, ['armada.create'])) class="active" @endif>
            <a href="{{ route('armada.create') }}"><i class="fa fa-circle-o"></i> Tambah Armada</a>
          </li>
          @endisset
          @isset($_menu->armada)
          <li @if(in_array($active, ['armada.index'])) class="active" @endif>
            <a href="{{ route('armada.index') }}"><i class="fa fa-circle-o"></i> Lihat Armada</a>
          </li>
          @endisset
        </ul>
      </li>
      @endisset
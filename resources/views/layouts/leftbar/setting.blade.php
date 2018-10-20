@isset($_menu->setting)
      <li class="treeview @if(in_array($active, ['satuan', 'satuan.create', 'satuan.edit','rekening', 'rekening.create', 'rekening.edit', 'vendor.index', 'vendor.create','vendor.edit','uam.index', 'uam.create','uam.edit','role-maker.index'])) active @endif ">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @isset($_menu->setting_uam)
          <li @if(in_array($active, ['uam.index', 'uam.create', 'uam.edit'])) class="active" @endif>
            <a href="{{ route('uam.index') }}"><i class="fa fa-circle-o"></i> User Account Management</a>
          </li>
          @endisset
          @isset($_menu->setting_vendor)
          <li @if(in_array($active, ['vendor.index', 'vendor.create', 'vendor.edit'])) class="active" @endif>
            <a href="{{ route('vendor.index') }}"><i class="fa fa-circle-o"></i> Vendor</a>
          </li>
          @endisset
          @isset($_menu->setting_satuan)
          <li @if(in_array($active, ['satuan', 'satuan.create', 'satuan.edit'])) class="active" @endif>
            <a href="{{ route('satuan') }}"><i class="fa fa-circle-o"></i> Satuan</a>
          </li>
          @endisset
          @isset($_menu->setting_rekening)
          <li @if(in_array($active, ['rekening', 'rekening.create', 'rekening.edit'])) class="active" @endif>
            <a href="{{ route('rekening') }}"><i class="fa fa-circle-o"></i> Rekening</a>
          </li>
          @endisset
          @isset($_menu->setting_kategori_armada)
          <li @if(in_array($active, ['kategori-armada.index'])) class="active" @endif>
            <a href="{{ route('kategori-armada.index') }}"><i class="fa fa-circle-o"></i> Kategori Armada</a>
          </li>
          @endisset
          @isset($_menu->setting_role_maker)
          <li @if(in_array($active, ['role-maker.index'])) class="active" @endif>
            <a href="{{ route('role-maker.index') }}"><i class="fa fa-circle-o"></i> Role Maker</a>
          </li>
          @endisset
        </ul>
      </li>
      @endisset
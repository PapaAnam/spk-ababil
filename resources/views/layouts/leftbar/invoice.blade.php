@isset($_menu->invoice)
      <li class="treeview @if(in_array($active, ['invoice.by-waktu','invoice.by-proyek','invoice.by-klien','invoice.create','invoice.index'])) active @endif ">
        <a href="#">
          <i class="fa fa-print"></i>
          <span>Invoice</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @isset($_menu->invoice_create)
          <li @if(in_array($active, ['invoice.create'])) class="active" @endif>
            <a href="{{ route('invoice.create') }}"><i class="fa fa-circle-o"></i> Tambah Invoice</a>
          </li>
          @endisset
          @isset($_menu->invoice)
          <li @if(in_array($active, ['invoice.by-waktu'])) class="active" @endif>
            <a href="{{ route('invoice.by-waktu') }}"><i class="fa fa-circle-o"></i> By Rentang Waktu</a>
          </li>
          <li @if(in_array($active, ['invoice.by-proyek'])) class="active" @endif>
            <a href="{{ route('invoice.by-proyek') }}"><i class="fa fa-circle-o"></i> By Proyek</a>
          </li>
          <li @if(in_array($active, ['invoice.by-klien'])) class="active" @endif>
            <a href="{{ route('invoice.by-klien') }}"><i class="fa fa-circle-o"></i> By Klien</a>
          </li>
          @endisset
        </ul>
      </li>
      @endisset
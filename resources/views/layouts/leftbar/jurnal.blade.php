@isset($_menu->jurnal)
      <li class="treeview @if(in_array($active, ['time-sheet.index','time-sheet.create','progress-kerja-harian.index','jam-alat.index','jam-alat.create','konsumsi-bbm.index','memo.index'])) active @endif ">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Jurnal</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @isset($_menu->timesheet)
          <li @if(in_array($active, ['time-sheet.index'])) class="active" @endif>
            <a href="{{ route('time-sheet.index') }}"><i class="fa fa-circle-o"></i> Time Sheet Karyawan</a>
          </li>
          @endisset
          @isset($_menu->laporan_progress_kerja_harian)
          <li class="{{ $active == 'progress-kerja-harian.index' ? 'active' : '' }}">
            <a href="{{ route('progress-kerja-harian.index') }}">
              <i class="fa fa-circle-o"></i> <span>Lap. Progress Kerja Harian</span>
            </a>
          </li>
          @endisset
          @isset($_menu->konsumsi_bbm)
          <li @if(in_array($active, ['konsumsi-bbm.index'])) class="active" @endif>
            <a href="{{ route('konsumsi-bbm.index') }}"><i class="fa fa-circle-o"></i> Konsumsi BBM</a>
          </li>
          @endisset
          @isset($_menu->jam_alat)
          <li @if(in_array($active, ['jam-alat.index'])) class="active" @endif>
            <a href="{{ route('jam-alat.index') }}"><i class="fa fa-circle-o"></i> Jam Alat</a>
          </li>
          @endisset
          @isset($_menu->memo)
          <li @if(in_array($active, ['memo.index'])) class="active" @endif>
            <a href="{{ route('memo.index') }}"><i class="fa fa-circle-o"></i> Memo</a>
          </li>
          @endisset
        </ul>
      </li>
      @endisset
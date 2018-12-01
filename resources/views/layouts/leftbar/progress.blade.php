@isset($_menu->progress)
<li class="treeview @if(in_array($active, ['progress.tugas','progress.proyek'])) active @endif ">
  <a href="#">
    <i class="fa fa-check-circle-o"></i>
    <span>Progress</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    @isset($_menu->progress_tugas)
    <li @if(in_array($active, ['progress.tugas'])) class="active" @endif>
      <a href="{{ route('progress.tugas') }}"><i class="fa fa-circle-o"></i> Tugas</a>
    </li>
    @endisset
    @isset($_menu->progress_proyek)
    <li @if(in_array($active, ['progress.proyek'])) class="active" @endif>
      <a href="{{ route('progress.proyek') }}"><i class="fa fa-circle-o"></i> Proyek</a>
    </li>
    @endisset
  </ul>
</li>
@endisset
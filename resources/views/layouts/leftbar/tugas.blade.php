@isset($_menu->tugas)
<li class="treeview @if(in_array($active, ['tugas.by-waktu','tugas.by-klien','tugas.by-proyek','tugas.create'])) active @endif ">
  <a href="#">
    <i class="fa fa-cubes"></i>
    <span>Tugas</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    @isset($_menu->tugas_create)
    <li @if(in_array($active, ['tugas.create'])) class="active" @endif>
      <a href="{{ route('tugas.create') }}"><i class="fa fa-circle-o"></i> Tambah Tugas</a>
    </li>
    @endisset
    @isset($_menu->tugas)
    <li @if(in_array($active, ['tugas.by-waktu'])) class="active" @endif>
      <a href="{{ route('tugas.by-waktu') }}"><i class="fa fa-circle-o"></i> By Rentang Waktu</a>
    </li>
    <li @if(in_array($active, ['tugas.by-klien'])) class="active" @endif>
      <a href="{{ route('tugas.by-klien') }}"><i class="fa fa-circle-o"></i> By Klien</a>
    </li>
    <li @if(in_array($active, ['tugas.by-proyek'])) class="active" @endif>
      <a href="{{ route('tugas.by-proyek') }}"><i class="fa fa-circle-o"></i> By Proyek</a>
    </li>
    @endisset
  </ul>
</li>
@endisset
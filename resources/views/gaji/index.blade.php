@extends('my-view')
@section('other-box')
<div class="row">
  @yield('filter')
</div>
@endsection
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Karyawan</th>
    <th>Jabatan</th>
    <th>Armada</th>
    <th>Total Gaji</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Karyawan</th>
    <th>Jabatan</th>
    <th>Armada</th>
    <th>Total Gaji</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->karyawan->nama }}</td>
    <td>{{ $d->jabatan }}</td>
    <td>{{ $d->armada }}</td>
    <td>{{ $d->total_gaji_rp }}</td>
    <td>
      @include('detail_button', ['link'=>route('gaji.show', [$d->id])])
      @include('delete_button',['link'=>route('gaji.destroy',[$d->id])])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
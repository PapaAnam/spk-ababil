@extends('my-view')
@section('table')
<thead>
  <tr>
    <th>ID Karyawan</th>
    <th>NIK</th>
    <th>Nama</th>
    <th>No Telp</th>
    <th>Jabatan</th>
    <th>Armada</th>
    <th>Aksi</th>
  </tr>
</thead>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td><?=$d->id?></td>
    <td><?=$d->nik?></td>
    <td><?=$d->nama?></td>
    <td><?=$d->no_hp?></td>
    <td><?=$d->jabatan?></td>
    <td><?=$d->armada?></td>
    <td>
      @include('edit_button', ['link' => route('karyawan.edit', [$d->id])])
      @include('delete_button', ['link' => route('karyawan.destroy', [$d->id])])
    </td>
  </tr>
  @endforeach
</tbody>
<tfoot>
  <tr>
    <th>ID Karyawan</th>
    <th>NIK</th>
    <th>Nama</th>
    <th>No Telp</th>
    <th>Jabatan</th>
    <th>Aksi</th>
  </tr>
</tfoot>
@endsection
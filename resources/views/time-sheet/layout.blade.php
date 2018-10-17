@extends('my-view')
@section('other-box')
@yield('filter')
@endsection
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>NIK</th>
    <th>Nama</th>
    <th>Tanggal</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
    <th>Ritase</th>
    <th>Istirahat</th>
    <th>Lembur</th>
    <th>Total Jam</th>
    @if('superadmin' == Auth::user()->role)
    <th>Aksi</th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td align="right">{{ $d->id }}</td>
    <td align="right">{{ $d->karyawan->nik }}</td>
    <td>{{ $d->karyawan->nama }}</td>
    <td>{{ $d->tanggal_indo }}</td>
    <td align="right">{{ $d->jam_mulai }}</td>
    <td align="right">{{ $d->jam_selesai }}</td>
    <td align="right">{{ $d->ritase }}</td>
    <td align="right">{{ $d->istirahat }}</td>
    <td align="right">{{ $d->lembur }}</td>
    <td align="right">{{ $d->total_jam }}</td>
    @if('superadmin' == Auth::user()->role)
    <td>
      @include('edit_button', ['link' => route('time-sheet.edit', [$d->id])])
      @include('delete_button', ['link' => route('time-sheet.destroy', [$d->id])])
    </td>
    @endif
  </tr>
  @endforeach
</tbody>
<tfoot>
  <tr>
    <th>ID</th>
    <th>NIK</th>
    <th>Nama</th>
    <th>Tanggal</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
    <th>Ritase</th>
    <th>Istirahat</th>
    <th>Lembur</th>
    <th>Total Jam</th>
    @if('superadmin' == Auth::user()->role)
    <th>Aksi</th>
    @endif
  </tr>
</tfoot>
@endsection

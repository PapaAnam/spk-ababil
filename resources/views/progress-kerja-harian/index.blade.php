@extends('my-view')
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Proyek</th>
    <th>Tugas</th>
    <th>Deskripsi</th>
    <th>Ritase</th>
    <th>Material</th>
    <th>Cuaca</th>
    <th>Kendala</th>
    @if('superadmin' == Auth::user()->role || 'admin' == Auth::user()->role)
    <th>Aksi</th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->tanggal_indo }}</td>
    <td>{{ $d->proyek->nama }}</td>
    <td>ID Tugas {{ $d->id_tugas }}</td>
    <td>{{ $d->deskripsi }}</td>
    <td align="right">{{ $d->ritase }}</td>
    <td>
      {{ $d->tugas->material }}
      <br>
      {{ $d->qty }}
      <br>
      {{ $d->tugas->satuandetail->nama }}
    </td>
    <td>{{ $d->cuaca }}</td>
    <td>{{ $d->kendala }}</td>
    @if('superadmin' == Auth::user()->role || 'admin' == Auth::user()->role)
    <td>
      @include('edit_button', ['link' => route('progress-kerja-harian.edit', [$d->id])])
      @include('delete_button', ['link' => route('progress-kerja-harian.destroy', [$d->id])])
    </td>
    @endif
  </tr>
  @endforeach
</tbody>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Proyek</th>
    <th>Tugas</th>
    <th>Deskripsi</th>
    <th>Ritase</th>
    <th>Material</th>
    <th>Cuaca</th>
    <th>Kendala</th>
    @if('superadmin' == Auth::user()->role || 'admin' == Auth::user()->role)
    <th>Aksi</th>
    @endif
  </tr>
</tfoot>
@endsection
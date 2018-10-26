@extends('my-view')
@section('other-box')
@yield('filter')
@endsection
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Klien</th>
    <th>Qty</th>
    <th>Satuan</th>
    <th>Mulai</th>
    <th>Akhir</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Klien</th>
    <th>Qty</th>
    <th>Satuan</th>
    <th>Mulai</th>
    <th>Akhir</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->nama }}</td>
    <td>{{ $d->kliendetail->nama_perusahaan }}</td>
    <td>{{ $d->qty }}</td>
    <td>{{ $d->satuandetail->nama }}</td>
    <td>{{ $d->start_date_indo }}</td>
    <td>{{ $d->end_date_indo }}</td>
    <td>
      @include('edit_button', ['link' => route('proyek.edit', [$d->id])])
      @include('delete_button', ['link' => route('proyek.destroy', [$d->id])])
    @include('detail_button', ['link' => route('proyek.show', [$d->id])])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
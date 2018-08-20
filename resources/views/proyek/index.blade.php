@extends('my-view')
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
    {{-- @if('superadmin' == Auth::user()->role) --}}
    <th>Aksi</th>
    {{-- @endif --}}
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
    {{-- @if('superadmin' == Auth::user()->role) --}}
    <th>Aksi</th>
    {{-- @endif --}}
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
    <td>{{ $d->start_date }}</td>
    <td>{{ $d->end_date }}</td>
    <td>
    @if('superadmin' == Auth::user()->role)
      @include('edit_button', ['link' => route('proyek.edit', [$d->id])])
      @include('delete_button', ['link' => route('proyek.destroy', [$d->id])])
    @endif
    @include('detail_button', ['link' => route('proyek.show', [$d->id])])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection

@include('import-datepicker')
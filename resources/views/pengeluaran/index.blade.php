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
    <th>No</th>
    <th>Tanggal</th>
    <th>Vendor</th>
    <th>Pelaksana</th>
    <th>Nominal</th>
    {{-- <th>Jumlah Pengeluaran</th> --}}
    <th>Proyek</th>
    <th>Kategori</th>
    <th>Deskripsi</th>
    <th>Ref</th>
    <th>Kwitansi</th>
    @if(Auth::user()->role == 'superadmin')
    <th>Aksi</th>
    @endif
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>No</th>
    <th>Tanggal</th>
    <th>Vendor</th>
    <th>Pelaksana</th>
    <th>Nominal</th>
    {{-- <th>Jumlah Pengeluaran</th> --}}
    <th>Proyek</th>
    <th>Kategori</th>
    <th>Deskripsi</th>
    <th>Ref</th>
    <th>Kwitansi</th>
    @if(Auth::user()->role == 'superadmin')
    <th>Aksi</th>
    @endif
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->no }}</td>
    <td>{{ $d->tanggal_indo }}</td>
    <td>{{ $d->vendor->nama }}</td>
    <td>{{ $d->pelaksana->nama }}</td>
    <td align="right">{{ number_format($d->nominal, 0, ',', '.') }}</td>
    {{-- <td align="right">{{ number_format($d->jumlah_pengeluaran, 0, ',', '.') }}</td> --}}
    <td>{{ $d->proyek->nama }}</td>
    <td>
      {{ $d->kategori->nama }} <br>
      {{ $d->subkategori ? $d->subkategori->nama : '' }}
    </td>
    <td>{{ $d->deskripsi }}</td>
    <td>{{ $d->ref }}</td>
    <td>@if($d->kwitansi)<a href="{{ $d->kwitansi }}" target="_blank">Lihat</a>@endif</td>
    @if(Auth::user()->role == 'superadmin')
    <td>
      @include('edit_button', ['link' => route('pengeluaran.edit', [$d->id])])
      @include('delete_button', ['link' => route('pengeluaran.destroy', [$d->id])])
    </td>
    @endif
  </tr>
  @endforeach
</tbody>
@endsection

@if(count($data) > 0)
@section('bottom-box')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Total Pengeluaran</h3>
  </div>
  <div class="box-body">
    <dl>
      <dd>Total Pengeluaran</dd>
      <dt>{{number_format($data->sum('nominal'), 0, ',', '.')}}</dt>
    </dl>
  </div>
</div>
@endsection
@endif
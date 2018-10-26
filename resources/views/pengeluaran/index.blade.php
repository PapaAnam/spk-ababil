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
    <th>Metode Pembayaran</th>
    <th>Proyek</th>
    <th>Kategori</th>
    <th>Deskripsi</th>
    <th>Ref</th>
    <th>Kwitansi</th>
    <th>Aksi</th>
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
    <th>Metode Pembayaran</th>
    <th>Proyek</th>
    <th>Kategori</th>
    <th>Deskripsi</th>
    <th>Ref</th>
    <th>Kwitansi</th>
    <th>Aksi</th>
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
    <td>{{$d->metode_pembayaran}}</td>
    <td>{{ $d->proyek->nama }}</td>
    <td>
      {{ $d->kategori->nama }} <br>
      {{ $d->subkategori ? $d->subkategori->nama : '' }}
    </td>
    <td>{{ $d->deskripsi }}</td>
    <td>{{ $d->ref }}</td>
    <td>@if($d->kwitansi)<a href="{{ $d->kwitansi }}" target="_blank">Lihat</a>@endif</td>
    <td>
      @include('edit_button', ['link' => route('pengeluaran.edit', [$d->id])])
      @include('delete_button', ['link' => route('pengeluaran.destroy', [$d->id])])
    </td>
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
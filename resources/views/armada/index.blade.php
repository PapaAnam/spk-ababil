@extends('my-view')
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Nama Unit</th>
    <th>Kategori</th>
    <th>Vendor</th>
    <th>Plat No</th>
    <th>Merk</th>
    {{-- <th>Model</th>
    <th>Seri</th>
    <th>Tahun</th>
    <th>Warna</th> --}}
    <th>Km/jam</th>
    <th>Mulai</th>
    <th>Selesai</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Nama Unit</th>
    <th>Kategori</th>
    <th>Vendor</th>
    <th>Plat No</th>
    <th>Merk</th>
    {{-- <th>Model</th>
    <th>Seri</th>
    <th>Tahun</th>
    <th>Warna</th> --}}
    <th>Km/jam</th>
    <th>Mulai</th>
    <th>Selesai</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d) 
  <tr>
    <td>{{$d->id}}</td>
    <td>{{$d->kategori->nama}}</td>
    <td>{{$d->vendor->nama}}</td>
    <td>{{$d->plat_no}}</td>
    <td>{{$d->merk}}</td>
    {{-- <td>{{$d->model}}</td>
    <td>{{$d->seri}}</td>
    <td>{{$d->tahun}}</td>
    <td>{{$d->warna}}</td> --}}
    <td>{{$d->km_per_jam}}</td>
    <td>{{tglIndo($d->mulai)}}</td>
    <td>{{tglIndo($d->selesai)}}</td>
    <td>
      @include('edit_button', ['link' => route('armada.edit', $d->id)])
      @include('delete_button', ['link' => route('armada.destroy', $d->id)])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
@extends('my-view')
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Armada</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
    <th>Istirahat</th>
    <th>Total Jam</th>
    <th>Pekerjaan</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Armada</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
    <th>Istirahat</th>
    <th>Total Jam</th>
    <th>Pekerjaan</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d) 
  <tr>
    <td>{{$d->id}}</td>
    <td>{{$d->armada->nama_unit}}</td>
    <td>{{$d->jam_mulai}}</td>
    <td>{{$d->jam_selesai}}</td>
    <td>{{$d->istirahat}}</td>
    <td>{{round((strtotime($d->jam_selesai)-strtotime($d->jam_mulai))/3600-$d->istirahat,2)}}</td>
    <td>{{$d->pekerjaan}}</td>
    <td>
      @include('edit_button', ['link' => route('jam-alat.edit', $d->id)])
      @include('delete_button', ['link' => route('jam-alat.destroy', $d->id)])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
@extends('my-view')
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Armada</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Armada</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d) 
  <tr>
    <td>{{$d->id}}</td>
    <td>{{$d->armada->id}}</td>
    <td>{{$d->jam_mulai}}</td>
    <td>{{$d->jam_selesai}}</td>
    <td>
      @include('edit_button', ['link' => route('jam-alat.edit', $d->id)])
      @include('delete_button', ['link' => route('jam-alat.destroy', $d->id)])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
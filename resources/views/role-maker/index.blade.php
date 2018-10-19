@extends('my-view')
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Nama Role</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Nama Role</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d) 
  <tr>
    <td>{{$d->id}}</td>
    <td>{{$d->nama}}</td>
    <td>
      @include('edit_button', ['link' => route('role-maker.edit', $d->id)])
      @include('delete_button', ['link' => route('role-maker.destroy', $d->id)])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
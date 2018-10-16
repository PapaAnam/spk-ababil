@extends('my-view')
@section('table')
<thead>
  <tr>
    <th>ID Kategori Armada</th>
    <th>Nama Kategori Armada</th>
    <th>Aksi</th>
  </tr>
</thead>
<tbody>
  @foreach ($data as $d) 
  <tr>
    <td><?=$d->id?></td>
    <td><?=$d->nama?></td>
    <td>
      @include('edit_button', ['link' => route('kategori-armada.edit', $d->id)])
      @include('delete_button', ['link' => route('kategori-armada.destroy', $d->id)])
    </td>
  </tr>
  @endforeach
</tbody>
<tfoot>
  <tr>
    <th>ID Kategori Armada</th>
    <th>Nama Kategori Armada</th>
    <th>Aksi</th>
  </tr>
</tfoot>
@endsection
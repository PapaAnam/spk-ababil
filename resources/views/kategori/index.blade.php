@extends('my-view')
@if(Auth::user()->role == 'superadmin')
@section('table')
<thead>
  <tr>
    <th>ID Kategori</th>
    <th>Nama</th>
    <th>Sub</th>
    <th>Aksi</th>
  </tr>
</thead>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->nama }}</td>
    <td>
      <ul>
        @foreach($d->sub as $p)
        <li>
          {{ $p->nama }}
          <a href="{{ route('sub-kategori.edit',[$d->id, $p->id]) }}"><i class="fa fa-pencil"></i></a>
          <a onclick="hapus('{{ route('sub-kategori.destroy',[$d->id, $p->id]) }}', event)" href="#"><i class="fa fa-trash"></i></a>
        </li>
        @endforeach
      </ul>
    </td>
    <td>
      <a href="{{ route('sub-kategori.create', [$d->id]) }}" class="btn btn-primary btn-flat">Tambah Sub</a>
      @include('edit_button', ['link' => route('kategori.edit', [$d->id])])
      @include('delete_button', ['link' => route('kategori.destroy', [$d->id])])
    </td>
  </tr>
  @endforeach
</tbody>
<tfoot>
  <tr>
    <th>ID Kategori</th>
    <th>Nama</th>
    <th>Sub</th>
    <th>Aksi</th>
  </tr>
</tfoot>
@endsection
@endif
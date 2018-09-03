@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Proyek</th>
    <th>Klien</th>
    <th>Deskripsi</th>
    <th>Material</th>
    <th>Qty</th>
    <th>Satuan</th>
    <th>Pelaksana</th>
    <th>Mulai</th>
    <th>Akhir</th>
    @if('superadmin' == Auth::user()->role || 'admin' == Auth::user()->role)
    <th>Aksi</th>
    @endif
  </tr>
</thead>
<tfoot>
    <tr>
    <th>ID</th>
    <th>Proyek</th>
    <th>Klien</th>
    <th>Deskripsi</th>
    <th>Material</th>
    <th>Qty</th>
    <th>Satuan</th>
    <th>Pelaksana</th>
    <th>Mulai</th>
    <th>Akhir</th>
    @if('superadmin' == Auth::user()->role || 'admin' == Auth::user()->role)
    <th>Aksi</th>
    @endif
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->proyek->nama }}</td>
    <td>{{ $d->proyek->kliendetail->nama_perusahaan }}</td>
    <td>{{ $d->deskripsi }}</td>
    <td>{{ $d->material }}</td>
    <td>{{ $d->qty }}</td>
    <td>{{ $d->satuandetail->nama }}</td>
    <td>
      @if(count($d->pelaksana) > 0)
      <ul>
        @foreach($d->pelaksana as $pelaksana)
        <li>{{ $pelaksana->karyawan->nama }}</li>
        @endforeach
      </ul>
      @endif
    </td>
    <td>{{ $d->start_date_indo }}</td>
    <td>{{ $d->end_date_indo }}</td>
    @if('superadmin' == Auth::user()->role || 'admin' == Auth::user()->role)
    <td>
      @include('edit_button', ['link' => route('tugas.edit', [$d->id])])
      @include('delete_button', ['link' => route('tugas.destroy', [$d->id])])
    </td>
    @endif
  </tr>
  @endforeach
</tbody>
@endsection
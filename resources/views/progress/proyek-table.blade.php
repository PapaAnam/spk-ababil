@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Klien</th>
    {{-- <th>Qty</th> --}}
    <th>Tugas</th>
    <th>%</th>
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
    {{-- <th>Qty</th> --}}
    <th>Tugas</th>
    <th>%</th>
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
    {{-- <td>{{ $d->qty }}</td> --}}
    <td>{{$d->tugas_count}}</td>
    <td>{{$d->persentase}}</td>
    <td>{{ $d->satuandetail->nama }}</td>
    <td>{{ $d->start_date_indo }}</td>
    <td>{{ $d->end_date_indo }}</td>
    <td>
    @include('detail_button', ['link' => route('progress.cek-proyek', [$d->id])])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
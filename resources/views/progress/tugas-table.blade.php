@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Nama Tugas</th>
    <th>Proyek</th>
    <th>Klien</th>
    <th>Deskripsi</th>
    <th>Qty</th>
    <th>Progress</th>
    <th>Satuan</th>
    <th>%</th>
    <th>Mulai</th>
    <th>Akhir</th>
    <th>Aksi</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Nama Tugas</th>
    <th>Proyek</th>
    <th>Klien</th>
    <th>Deskripsi</th>
    <th>Qty</th>
    <th>Progress</th>
    <th>Satuan</th>
    <th>%</th>
    <th>Mulai</th>
    <th>Akhir</th>
    <th>Aksi</th>
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    <td>{{ $d->nama_tugas }}</td>
    <td>{{ $d->nama_proyek }}</td>
    <td>{{ $d->nama_perusahaan }}</td>
    <td>{{ $d->deskripsi }}</td>
    <td>{{ $d->qty }}</td>
    <td>{{$d->progress}}</td>
    <td>{{ $d->nama_satuan }}</td>
    <td>{{$d->persentase}}</td>
    <td>{{ tglIndo($d->start_date) }}</td>
    <td>{{ tglIndo($d->end_date) }}</td>
    <td>
      @include('detail_button', ['link' => route('progress.detail-tugas', [$d->id_tugas,$d->id_proyek])])
    </td>
  </tr>
  @endforeach
</tbody>
@endsection
@extends('my-view')
@section('other-box')
@yield('filter')
@endsection
@section('table')
<thead>
    <tr>
        <th>No</th>
        <th>Pesan</th>
        <th>Tanggal</th>
        <th>Deadline</th>
        <th>Klien</th>
        <th>Proyek</th>
        <th>Pelaksana</th>
        <th>Jenis Karyawan</th>
        @if('superadmin' == Auth::user()->role)
        <th>Aksi</th>
        @endif
    </tr>
</thead>
<tfoot>
    <tr>
        <th>No</th>
        <th>Pesan</th>
        <th>Tanggal</th>
        <th>Deadline</th>
        <th>Klien</th>
        <th>Proyek</th>
        <th>Pelaksana</th>
        <th>Jenis Karyawan</th>
        @if('superadmin' == Auth::user()->role)
        <th>Aksi</th>
        @endif
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td align="right">{{ $d->id }}</td>
        <td>{{ $d->pesan }}</td>
        <td>{{ $d->tanggal }}</td>
        <td>{{ $d->deadline }}</td>
        <td>{{ $d->klien->nama_perusahaan }}</td>
        <td>{{ $d->proyek->nama }}</td>
        <td>
            <ul>
                @foreach ($d->pelaksana as $p)
                    <li>{{ $p->karyawan ? $p->karyawan->nama : "" }}</li>
                @endforeach
            </ul>
        </td>
        <td>
            <ul>
                @foreach ($d->jeniskaryawan as $p)
                    <li>{{ $p->jenis_karyawan }}</li>
                @endforeach
            </ul>
        </td>
        @if('superadmin' == Auth::user()->role)
        <td>
            @include('edit_button', ['link' => route('memo.edit', [$d->id])])
            @include('delete_button', ['link' => route('memo.destroy', [$d->id])])
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
@endsection

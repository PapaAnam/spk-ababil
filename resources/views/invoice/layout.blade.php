@extends('my-view')
@section('other-box')
@yield('filter')
@endsection
@section('table')
<thead>
  <tr>
    <th>ID</th>
    <th>Jatuh Tempo</th>
    <th>Tanggal</th>
    <th width="200px">No Invoice</th>
    <th>Client</th>
    <th>PIC</th>
    <th>Pekerjaan</th>
    <th>Deskripsi</th>
    <th>Total Tagihan</th>
    <th>Terbayar</th>
    <th>Tertagih</th>
    <th>Pajak</th>
    <th width="300px">Detail Bank Account</th>
    <th>Ttd</th>
    <th>Jumlah Tagihan</th>
    {{-- @if('superadmin' == Auth::user()->role) --}}
    <th>Aksi</th>
    {{-- @endif --}}
  </tr>
</thead>
<tfoot>
  <tr>
    <th>ID</th>
    <th>Jatuh Tempo</th>
    <th>Tanggal</th>
    <th width="200px">No Invoice</th>
    <th>Client</th>
    <th>PIC</th>
    <th>Pekerjaan</th>
    <th>Deskripsi</th>
    <th>Total Tagihan</th>
    <th>Terbayar</th>
    <th>Tertagih</th>
    <th>Pajak</th>
    <th width="300px">Detail Bank Account</th>
    <th>Ttd</th>
    <th>Jumlah Tagihan</th>
    {{-- @if('superadmin' == Auth::user()->role) --}}
    <th>Aksi</th>
    {{-- @endif --}}
  </tr>
</tfoot>
<tbody>
  @foreach ($data as $d)
  <tr>
    <td>{{ $d->id }}</td>
    @php
        $jatuhTempo = (strtotime($d->tanggal)-strtotime(date('Y-m-d')))/3600/24;
    @endphp
    <td>{!! $jatuhTempo > 0 ? '<font color="red">'.$jatuhTempo.'</font>' : $jatuhTempo !!}</td>
    <td>{{ $d->tanggal_indo }}</td>
    <td>{{ $d->no_invoice }}</td>
    <td>{{ $d->proyek->kliendetail->nama_perusahaan }}</td>
    <td>
      <ul>
        @foreach($d->proyek->kliendetail->pic as $pic)
        <li>{{ $pic->tipe.' '.$pic->nama }}</li>
        @endforeach
      </ul>
    </td>
    <td>{{ $d->proyek->nama }}</td>
    <td>{{ $d->deskripsi }}</td>
    <td align="right">{{ number_format($d->total_tagihan, 0, ',', '.') }}</td>
    <td align="right">{{ number_format($d->terbayar, 0, ',', '.') }}</td>
    <td align="right">{{ number_format($d->tertagih, 0, ',', '.') }}</td>
    <td>
      <ul>
        {{-- @php
            $totalPajak = 0;
        @endphp --}}
        @foreach($d->pajak as $pajak)
        {{-- @php
            $totalPajak += ($d->tertagih*$pajak->pajak/100);
        @endphp --}}
        <li>{{ $pajak->nama.' : '.number_format($pajak->pajak, 0, ',', '.') }}</li>
        @endforeach
      </ul>
    </td>
    <td>{{ $d->rekening->bank }}</td>
    <td>{{ $d->ttd->nama_lengkap }}</td>
    <td>
        {{-- {{number_format($d->tertagih+$totalPajak, 0, ',', '.')}} --}}
        {{number_format($d->jumlah_tagihan, 0, ',', '.')}}
    </td>
    {{-- @if('superadmin' == Auth::user()->role) --}}
    <td>
      @include('edit_button', ['link' => route('invoice.edit', [$d->id])])
      @include('delete_button', ['link' => route('invoice.destroy', [$d->id])])
    </td>
    {{-- @endif --}}
  </tr>
  @endforeach
</tbody>
@endsection

@include('import-datepicker')
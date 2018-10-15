@extends('create-form')
@section('form')
@include('input_readonly',['id'=>'tanggal_dari','label'=>'Dari Tanggal','value'=>$d->tanggal_dari])
@include('input_readonly',['id'=>'tanggal_sampai','label'=>'Sampai Tanggal','value'=>$d->tanggal_sampai])
@include('input_readonly',['id'=>'karyawan','label'=>'Karyawan','value'=>$d->karyawan->nama])
@include('input_readonly',['id'=>'plat_no','label'=>'Plat No','value'=>$d->plat_no])
@include('input_readonly', ['id'=>'jabatan','label'=>'Jabatan','value'=>$d->jabatan])
@include('input_readonly', ['id'=>'armada','label'=>'Armada','value'=>$d->armada])
@include('input_readonly', ['id'=>'jenis','label'=>'Jenis Karyawan','value'=>$d->jenis])

@include('input_readonly', ['id'=>'total_jam_kerja','label'=>'Total Jam Kerja','value'=>$d->total_jam_kerja])
@include('input_readonly', ['id'=>'gaji_pokok','label'=>'Gaji Pokok','value'=>$d->gaji_pokok])
@if($d->jenis == 'Operator')
@include('input_readonly', ['id'=>'rate_per_jam','label'=>'Rate Per Jam','value'=>$d->rate_per_jam])
@include('input_readonly', ['id'=>'jumlah_jam','label'=>'Total Jam','value'=>$d->total_jam])
@endif

@include('input_readonly', ['id'=>'um_harian','label'=>'UM Harian','value'=>$d->um_harian])
@include('input_readonly', ['id'=>'jumlah_hari_timesheet','label'=>'Jumlah Hari Time Sheet','value'=>$d->jumlah_hari_timesheet])

{{-- except --}}
@include('input_readonly', ['id'=>'total_uang_makan','label'=>'Uang Makan Yang Diterima','value'=>$d->total_uang_makan])

{{-- @include('input_readonly', ['id'=>'rate_insentif','label'=>'Rate Insentif','value'=>$d->rate_insentif])
@include('input_readonly', ['id'=>'jumlah_insentif','label'=>'Jumlah Insentif','value'=>$d->jumlah_insentif]) --}}

{{-- except --}}
{{-- @include('input_readonly', ['id'=>'total_insentif','label'=>'Insentif Yang Diterima','value'=>$d->total_insentif]) --}}

{{-- @include('input_readonly', ['id'=>'rate_lembur','label'=>'Rate Lembur','value'=>$d->rate_lembur])
@include('input_readonly', ['id'=>'jumlah_lembur','label'=>'Jumlah Lembur','value'=>$d->jumlah_lembur]) --}}

{{-- except --}}
{{-- @include('input_readonly', ['id'=>'total_lembur','label'=>'Lembur Yang Diterima','value'=>$d->total_lembur]) --}}

@if($d->jenis == 'Sopir')
<hr>
@foreach ($d->insentif as $ins)
@include('input_readonly', ['id'=>'nama_insentif','label'=>$ins->insentifdetail->nama,'value'=>$ins['rate_insentif'],'name'=>'nama_insentif[]'])
@include('input_readonly', ['id'=>'jumlah_insentif','label'=>'Jumlah Insentif','value'=>$ins['jumlah_insentif'],'name'=>'jumlah_insentif[]'])
@include('input_readonly', ['id'=>'insentif_diterima','label'=>'Insentif Diterima','value'=>$ins['jumlah_insentif']*$ins['rate_insentif'],'name'=>'insentif_diterima[]'])
@include('input_readonly', ['id'=>'rate_lembur','label'=>'Lembur '.$loop->iteration,'value'=>$ins['rate_lembur'],'name'=>'rate_lembur[]'])
@include('input_readonly', ['id'=>'jumlah_lembur','label'=>'Jumlah Lembur','value'=>$ins['jumlah_lembur'],'name'=>'jumlah_lembur[]'])
@include('input_readonly', ['id'=>'lembur_diterima','label'=>'Lembur Diterima','value'=>$ins['jumlah_lembur']*$ins['rate_lembur'],'name'=>'lembur_diterima[]'])
<hr>
@endforeach
@elseif($d->jenis == 'Operator')
<hr>
@foreach ($d->overtime as $ot)
@include('input_readonly', ['id'=>'nama_overtime','label'=>$ot->overtimedetail->nama,'value'=>$ot['rate_overtime'],'name'=>'nama_overtime[]'])
@include('input_readonly', ['id'=>'jumlah_overtime','label'=>'Jumlah Overtime','value'=>$ot['jumlah_overtime'],'name'=>'jumlah_overtime[]'])
@include('input_readonly', ['id'=>'overtime_diterima','label'=>'Overtime Diterima','value'=>$ot['jumlah_overtime']*$ot['rate_overtime'],'name'=>'overtime_diterima[]'])
<hr>
@endforeach
@endif

@if(count($d->pengeluaran) > 0)
<h4>Pengeluaran</h4>
@foreach($d->pengeluaran as $p)
@include('input_readonly',['id'=>'pengeluaran','name'=>'pengeluaran','label'=>'Pengeluaran '.$loop->iteration,'value'=>$p->jumlah])
@include('textarea_readonly',['id'=>'deskripsi','label'=>'Deskripsi '.$loop->iteration,'value'=>$p->deskripsi])
@endforeach
@endif
@include('input_readonly',['id'=>'total_gaji','label'=>'Total Gaji','value'=>$d->total_gaji])

@endsection
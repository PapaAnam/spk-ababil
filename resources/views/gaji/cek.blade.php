@include('input_readonly', ['id'=>'jabatan','label'=>'Jabatan','value'=>$k->jabatan])
@include('input_readonly', ['id'=>'armada','label'=>'Armada','value'=>$k->armada])
@include('input_readonly', ['id'=>'total_jam_kerja','label'=>'Total Jam Kerja','value'=>$totalJamKerja])
@include('input_readonly', ['id'=>'gaji_pokok','label'=>'Gaji Pokok','value'=>$k->gaji_pokok])

@if($k->jenis == 'Operator')
@include('input_readonly', ['id'=>'rate_per_jam','label'=>'Rate Per Jam','value'=>$k->rate_per_jam])

{{-- except --}}
@include('input_readonly', ['id'=>'jumlah_jam','label'=>'Total Jam','value'=>$k->rate_per_jam*$totalJamKerja])
@endif

@include('input_readonly', ['id'=>'um_harian','label'=>'UM Harian','value'=>$k->um_harian])
@include('input_readonly', ['id'=>'jumlah_hari_timesheet','label'=>'Jumlah Hari Time Sheet','value'=>$jumlahHariTimeSheet])

{{-- except --}}
@include('input_readonly', ['id'=>'total_uang_makan','label'=>'Uang Makan Yang Diterima','value'=>$jumlahHariTimeSheet * $k->um_harian])

{{-- @include('input_readonly', ['id'=>'rate_insentif','label'=>'Rate Insentif','value'=>$k->jenis == 'Sopir' ? $k->insentif : 0]) --}}
{{-- @include('input_readonly', ['id'=>'jumlah_insentif','label'=>'Jumlah Insentif','value'=>$k->jenis == 'Sopir' ? $jumlahInsentif : 0]) --}}

{{-- except --}}
{{-- @include('input_readonly', ['id'=>'total_insentif','label'=>'Insentif Yang Diterima','value'=>$k->jenis == 'Sopir' ? ($jumlahInsentif * $k->insentif) : 0]) --}}
@if($k->jenis != 'Sopir' && $k->jenis != 'Operator')
@include('input_readonly', ['id'=>'rate_lembur','label'=>'Rate Lembur','value'=>$k->rate_lembur])
@include('input_readonly', ['id'=>'jumlah_lembur','label'=>'Jumlah Lembur','value'=>$jumlahLembur])
@include('input_readonly', ['id'=>'total_lembur','label'=>'Lembur Yang Diterima','value'=>$jumlahLembur * $k->rate_lembur])
@endif

{{-- except --}}

<input type="hidden" id="jenis_karyawan" value="{{$k->jenis}}">
@if($k->jenis == 'Sopir')

@foreach ($insentif as $ins)
<hr>
<input type="hidden" value="{{$ins['id_insentif']}}" name="id_insentif[]">
@include('input_readonly', ['id'=>'rate_insentif','label'=>$ins['nama_insentif'],'value'=>$ins['rate_insentif'],'name'=>'rate_insentif[]'])
@include('input_readonly', ['id'=>'jumlah_insentif','label'=>'Jumlah Insentif','value'=>$ins['jumlah'],'name'=>'jumlah_insentif[]'])
@include('input_readonly', ['id'=>'insentif_diterima','label'=>'Insentif Diterima','value'=>$ins['jumlah']*$ins['rate_insentif'],'name'=>'insentif_diterima[]'])
@include('input_readonly', ['id'=>'rate_lembur','label'=>'Lembur '.$loop->iteration,'value'=>$ins['rate_lembur'],'name'=>'rate_lembur[]'])
@include('input_readonly', ['id'=>'jumlah_lembur','label'=>'Jumlah Lembur','value'=>$ins['jumlah_lembur'],'name'=>'jumlah_lembur[]'])
@include('input_readonly', ['id'=>'lembur_diterima','label'=>'Lembur Diterima','value'=>$ins['jumlah_lembur']*$ins['rate_lembur'],'name'=>'lembur_diterima[]'])
<input type="hidden" class="jl" value="{{$ins['jumlah']*$ins['rate_insentif']+$ins['jumlah_lembur']*$ins['rate_lembur']}}">
@endforeach

@elseif($k->jenis == 'Operator')
@foreach ($overtime as $ot)
<hr>
<input type="hidden" value="{{$ot['id_overtime']}}" name="id_overtime[]">
@include('input_readonly', ['id'=>'rate_overtime','label'=>$ot['nama_overtime'],'value'=>$ot['rate_overtime'],'name'=>'rate_overtime[]'])
@include('input_readonly', ['id'=>'jumlah_overtime','label'=>'Jumlah Overtime','value'=>$ot['jumlah_overtime'],'name'=>'jumlah_overtime[]'])
@include('input_readonly', ['id'=>'overtime_diterima','label'=>'Overtime Diterima','value'=>$ot['jumlah_overtime']*$ot['rate_overtime'],'name'=>'overtime_diterima[]'])
<input type="hidden" class="jl" value="{{$ot['jumlah_overtime']*$ot['rate_overtime']}}">
@endforeach
@endif

<input type="hidden" name="jenis" value="{{ $k->jenis }}">
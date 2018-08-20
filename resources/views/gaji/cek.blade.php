@include('input_readonly', ['id'=>'jabatan','label'=>'Jabatan','value'=>$k->jabatan])
@include('input_readonly', ['id'=>'armada','label'=>'Armada','value'=>$k->armada])
@include('input_readonly', ['id'=>'total_jam_kerja','label'=>'Total Jam Kerja','value'=>$totalJamKerja])
@include('input_readonly', ['id'=>'gaji_pokok','label'=>'Gaji Pokok','value'=>$k->gaji_pokok])
@include('input_readonly', ['id'=>'rate_per_jam','label'=>'Rate Per Jam','value'=>$k->jenis == 'Operator' ? $k->rate_per_jam : 0])

{{-- except --}}
@include('input_readonly', ['id'=>'jumlah_jam','label'=>'Total Jam','value'=>$k->jenis == 'Operator' ? ($k->rate_per_jam*$totalJamKerja) : 0])

@include('input_readonly', ['id'=>'um_harian','label'=>'UM Harian','value'=>$k->um_harian])
@include('input_readonly', ['id'=>'jumlah_hari_timesheet','label'=>'Jumlah Hari Time Sheet','value'=>$jumlahHariTimeSheet])

{{-- except --}}
@include('input_readonly', ['id'=>'total_uang_makan','label'=>'Uang Makan Yang Diterima','value'=>$jumlahHariTimeSheet * $k->um_harian])

@include('input_readonly', ['id'=>'rate_insentif','label'=>'Rate Insentif','value'=>$k->jenis == 'Sopir' ? $k->insentif : 0])
@include('input_readonly', ['id'=>'jumlah_insentif','label'=>'Jumlah Insentif','value'=>$k->jenis == 'Sopir' ? $jumlahInsentif : 0])

{{-- except --}}
@include('input_readonly', ['id'=>'total_insentif','label'=>'Insentif Yang Diterima','value'=>$k->jenis == 'Sopir' ? ($jumlahInsentif * $k->insentif) : 0])

@include('input_readonly', ['id'=>'rate_lembur','label'=>'Rate Lembur','value'=>$k->rate_lembur])
@include('input_readonly', ['id'=>'jumlah_lembur','label'=>'Jumlah Lembur','value'=>$jumlahLembur])

{{-- except --}}
@include('input_readonly', ['id'=>'total_lembur','label'=>'Lembur Yang Diterima','value'=>$jumlahLembur * $k->rate_lembur])

<input type="hidden" name="jenis" value="{{ $k->jenis }}">
@php
$_pengaturan = \App\Pengaturan::where('key', 'tahun')->first();
$tahun = $_pengaturan->value;
$_pengaturan = \App\Pengaturan::where('key', 'nama_aplikasi_footer')->first();
$app = $_pengaturan->value;
$_pengaturan = \App\Pengaturan::where('key', 'versi')->first();
$versi = $_pengaturan->value;
@endphp
<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> {{$versi}}
	</div>
	<strong>Copyright &copy; {{ date('Y') == $tahun ? $tahun : $tahun.'-'.date('Y') }} <a href="{{ url('') }}">{{$app}}</a>.</strong> All rights
	reserved.
</footer>
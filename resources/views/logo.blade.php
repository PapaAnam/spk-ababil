@php
$_pengaturan = \App\Pengaturan::where('key', 'nama_aplikasi')->first();
$namaApp = $_pengaturan->value;
$_pengaturan = \App\Pengaturan::where('key', 'nama_aplikasi_mobile')->first();
$namaAppMobile = $_pengaturan->value;
@endphp
<a href="{{ url('') }}" class="logo">
	<span class="logo-mini">
		{!!$namaAppMobile!!}
	</span>
	<span class="logo-lg">
		{!!$namaApp!!}
	</span>
</a>
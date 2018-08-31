@extends('my-container')
@section('other-box')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Lihat berdasarkan</h3>
	</div>
	<div class="box-body">
		<a class="btn btn-primary btn-flat" href="{{ route('tugas.by-waktu') }}">Rentang waktu</a>
		<a class="btn btn-primary btn-flat" href="{{ route('tugas.by-klien') }}">Klien</a>
		<a class="btn btn-primary btn-flat" href="{{ route('tugas.by-proyek') }}">Proyek</a>
	</div>
</div>
@endsection
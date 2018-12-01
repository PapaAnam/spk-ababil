@extends('create-form')
@section('form')
@method('PUT')
@include('input',['id'=>'nama','value'=>$d->nama,'label'=>'Nama Role'])
@php
	$p = json_decode($d->hak_akses);
@endphp
<div class="col-md-12"><hr></div>
<h4>Pilih menu yang bisa diakses</h4>
<div class="col-md-3">
	@include('icheck',['id'=>'check_all','label'=>'Centang Semua'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'dasbor','checked'=>isset($p->dasbor) ? true : false,'label'=>'Dasbor'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'progress','checked'=>isset($p->progress) ? true : false,'label'=>'Progress'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'progress_tugas','checked'=>isset($p->progress_tugas) ? true : false,'label'=>'Progress > Tugas'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'progress_proyek','checked'=>isset($p->progress_proyek) ? true : false,'label'=>'Progress > Proyek'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'jurnal','checked'=>isset($p->jurnal) ? true : false,'label'=>'Jurnal'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'timesheet','checked'=>isset($p->timesheet) ? true : false,'label'=>'Time Sheet'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'timseheet_create','checked'=>isset($p->timseheet_create) ? true : false,'label'=>'Tambah Time Sheet'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'laporan_progress_kerja_harian','checked'=>isset($p->laporan_progress_kerja_harian) ? true : false,'label'=>'Laporan Progress Kerja Harian'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'konsumsi_bbm','checked'=>isset($p->konsumsi_bbm) ? true : false,'label'=>'Konsumsi BBM'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'jam_alat','checked'=>isset($p->jam_alat) ? true : false,'label'=>'Jam Alat'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'memo','checked'=>isset($p->memo) ? true : false,'label'=>'Memo'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'proyek','checked'=>isset($p->proyek) ? true : false,'label'=>'Proyek'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'proyek_create','checked'=>isset($p->proyek_create) ? true : false,'label'=>'Tambah Proyek'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'tugas','checked'=>isset($p->tugas) ? true : false,'label'=>'Tugas'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'tugas_create','checked'=>isset($p->tugas) ? true : false,'label'=>'Tambah Tugas'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'invoice','checked'=>isset($p->invoice) ? true : false,'label'=>'Invoice'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'invoice_create','checked'=>isset($p->invoice_create) ? true : false,'label'=>'Tambah Invoice'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran','checked'=>isset($p->pengeluaran) ? true : false,'label'=>'Pengeluaran'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran_create','checked'=>isset($p->pengeluaran_create) ? true : false,'label'=>'Tambah Pengeluaran'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran_user_saat_ini','checked'=>isset($p->pengeluaran_user_saat_ini) ? true : false,'label'=>'User'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran_user_semua','checked'=>isset($p->pengeluaran_user_semua) ? true : false,'label'=>'Semua'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'karyawan','checked'=>isset($p->karyawan) ? true : false,'label'=>'Karyawan'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'karyawan_create','checked'=>isset($p->karyawan_create) ? true : false,'label'=>'Tambah Karyawan'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'keuangan','checked'=>isset($p->keuangan) ? true : false,'label'=>'Keuangan'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'keuangan_create','checked'=>isset($p->keuangan_create) ? true : false,'label'=>'Hitung Gaji'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'klien','checked'=>isset($p->klien) ? true : false,'label'=>'Klien'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'klien_create','checked'=>isset($p->klien_create) ? true : false,'label'=>'Tambah Klien'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'armada','checked'=>isset($p->armada) ? true : false,'label'=>'Armada'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'armada_create','checked'=>isset($p->armada_create) ? true : false,'label'=>'Tambah Armada'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting','checked'=>isset($p->setting) ? true : false,'label'=>'Setting'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_uam','checked'=>isset($p->setting_uam) ? true : false,'label'=>'User Account Management'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_vendor','checked'=>isset($p->setting_vendor) ? true : false,'label'=>'Vendor'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_satuan','checked'=>isset($p->setting_satuan) ? true : false,'label'=>'Satuan'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_rekening','checked'=>isset($p->setting_rekening) ? true : false,'label'=>'Rekening'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_kategori_armada','checked'=>isset($p->setting_kategori_armada) ? true : false,'label'=>'Kategori Armada'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_role_maker','checked'=>isset($p->setting_role_maker) ? true : false,'label'=>'Role Maker'])
</div>
@endsection
@include('import-icheck')
@include("role-maker.script")
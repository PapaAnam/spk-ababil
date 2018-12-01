@extends('create-form')
@section('form')
@include('input',['id'=>'nama','label'=>'Nama Role'])
<div class="col-md-12"><hr></div>
<h4>Pilih menu yang bisa diakses</h4>
<div class="col-md-3">
	@include('icheck',['id'=>'check_all','label'=>'Centang Semua'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'dasbor','label'=>'Dasbor'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'progress','label'=>'Progress'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'progress_tugas','label'=>'Progress > Tugas'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'progress_proyek','label'=>'Progress > Proyek'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'jurnal','label'=>'Jurnal'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'timesheet','label'=>'Time Sheet'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'timsheet_create','label'=>'Tambah Time Sheet'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'laporan_progress_kerja_harian','label'=>'Laporan Progress Kerja Harian'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'konsumsi_bbm','label'=>'Konsumsi BBM'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'jam_alat','label'=>'Jam Alat'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'memo','label'=>'Memo'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'proyek','label'=>'Proyek'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'proyek_create','label'=>'Tambah Proyek'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'tugas','label'=>'Tugas'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'tugas_create','label'=>'Tambah Tugas'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'invoice','label'=>'Invoice'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'invoice_create','label'=>'Tambah Invoice'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran','label'=>'Pengeluaran'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran_create','label'=>'Tambah Pengeluaran'])
</div>
{{-- <div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran_user_saat_ini','label'=>'User'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'pengeluaran_user','label'=>'Semua'])
</div> --}}
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'karyawan','label'=>'Karyawan'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'karyawan_create','label'=>'Tambah Karyawan'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'keuangan','label'=>'Keuangan'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'keuangan_create','label'=>'Hitung Gaji'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'klien','label'=>'Klien'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'klien_create','label'=>'Tambah Klien'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'armada','label'=>'Armada'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'armada_create','label'=>'Tambah Armada'])
</div>
<div class="col-md-12"><hr></div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting','label'=>'Setting'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_uam','label'=>'User Account Management'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_vendor','label'=>'Vendor'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_satuan','label'=>'Satuan'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_rekening','label'=>'Rekening'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_kategori_armada','label'=>'Kategori Armada'])
</div>
<div class="col-md-3">
	@include('icheck',['id'=>'setting_role_maker','label'=>'Role Maker'])
</div>
@endsection
@include('import-icheck')
@include('role-maker.script')
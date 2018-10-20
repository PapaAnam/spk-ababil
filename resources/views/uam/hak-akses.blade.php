@isset (Auth::user()->hakakses->menu->setting_role_maker)
<div class="form-group">
	<label for="" class="col-md-2 control-label"></label>
	<div class="col-md-6">
		<a href="{{route('role-maker.create')}}" class="btn btn-primary btn-flat" target="_blank">Tambah Role</a>
	</div>
</div>
@endisset
@foreach ($roles as $r)
@php
$p = $r->hak_akses;
@endphp
<div class="col-md-10 col-md-offset-1">
	<div id="role-{{$r->id}}" style="display: none;">
		<hr>
		<h4>Hak Akses</h4>
		<table class="table table-bordered table-striped">
			<tbody>
				<tr>
					@isset($p->dasbor)
					<td>
						Dasbor
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->progress)
					<td>
						Progress
					</td>
					@endif
					@isset($p->progress_tugas)
					<td>
						Progress > Tugas
					</td>
					@endif
					@isset($p->progress_proyek)
					<td>
						Progress > Proyek
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->jurnal)
					<td>
						Jurnal
					</td>
					@endif
					@isset($p->timesheet)
					<td>
						Time Sheet
					</td>
					@endif
					@isset($p->timsheet_create)
					<td>
						Tambah Time Sheet
					</td>
					@endif
					@isset($p->laporan_progress_kerja_harian)
					<td>
						Laporan Progress Kerja Harian
					</td>
					@endif
					@isset($p->konsumsi_bbm)
					<td>
						Konsumsi BBM
					</td>
					@endif
					@isset($p->jam_alat)
					<td>
						Jam Alat
					</td>
					@endif
					@isset($p->memo)
					<td>
						Memo
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->proyek)
					<td>
						Proyek
					</td>
					@endif
					@isset($p->proyek_create)
					<td>
						Tambah Proyek
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->tugas)
					<td>
						Tugas
					</td>
					@endif
					@isset($p->tugas_create)
					<td>
						Tambah Tugas
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->invoice)
					<td>
						Invoice
					</td>
					@endif
					@isset($p->invoice_create)
					<td>
						Tambah Invoice
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->pengeluaran)
					<td>
						Pengeluaran
					</td>
					@endif
					@isset($p->pengeluaran_create)
					<td>
						Tambah Pengeluaran
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->karyawan)
					<td>
						Karyawan
					</td>
					@endif
					@isset($p->karyawan_create)
					<td>
						Tambah Karyawan
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->keuangan)
					<td>
						Keuangan
					</td>
					@endif
					@isset($p->keuangan_create)
					<td>
						Hitung Gaji
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->klien)
					<td>
						Klien
					</td>
					@endif
					@isset($p->klien_create)
					<td>
						Tambah Klien
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->armada)
					<td>
						Armada
					</td>
					@endif
					@isset($p->armada_create)
					<td>
						Tambah Armada
					</td>
					@endif
				</tr>
				<tr>
					@isset($p->setting)
					<td>
						Setting
					</td>
					@endif
					@isset($p->setting_uam)
					<td>
						User Account Management
					</td>
					@endif
					@isset($p->setting_vendor)
					<td>
						Vendor
					</td>
					@endif
					@isset($p->setting_satuan)
					<td>
						Satuan
					</td>
					@endif
					@isset($p->setting_rekening)
					<td>
						Rekening
					</td>
					@endif
					@isset($p->setting_kategori_armada)
					<td>
						Kategori Armada
					</td>
					@endif
					@isset($p->setting_role_maker)
					<td>
						Role Maker
					</td>
					@endif
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endforeach
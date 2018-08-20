@extends('create-form')
@section('form')
@include('datepicker',['id'=>'tanggal_dari','label'=>'Dari Tanggal','value'=>date('Y-m-d')])
@include('datepicker',['id'=>'tanggal_sampai','label'=>'Sampai Tanggal','value'=>date('Y-m-d')])
@include('select',['id'=>'id_karyawan','label'=>'Pilih Karyawan','selectData'=>$listKaryawan])
@include('input',['id'=>'plat_no','label'=>'Plat No'])
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<button id="cek-gaji-btn" class="btn btn-primary btn-flat">
			Cek Gaji
		</button>
		<button id="batal-btn" class="btn btn-default btn-flat">
			Batal
		</button>
	</div>
</div>
<div id="cek-gaji-view"></div>

<hr>

<h4>Pengeluaran</h4>
<div id="pengeluaran-template">
	@if(count($errors->all()) <= 0)
	@include('input_number',['id'=>'pengeluaran','name'=>'pengeluaran[]','label'=>'Pengeluaran'])
	@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','array'=>true])
	@else
	@include('input_number',['id'=>'pengeluaran','name'=>'pengeluaran[]','label'=>'Pengeluaran','index'=>0])
	@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','array'=>true,'index'=>0])
	@endif
</div>
<div class="form-group">
	<label class="col-lg-2 control-label"></label>
	<div class="col-sm-6">
		<button id="tambah-pengeluaran-btn" class="btn btn-primary btn-flat">
			Tambah Pengeluaran
		</button>
		<button id="hitung-gaji-btn" class="btn btn-primary btn-flat">
			Hitung Gaji
		</button>
	</div>
</div>
<div id="pengeluaran-tambahan">
	@if(count(old('pengeluaran')) > 1)
	@for($i = 1; $i < count(old('pengeluaran')); $i++)
	<div id="siap-hapus">
	@include('input_number',['id'=>'pengeluaran','name'=>'pengeluaran[]','label'=>'Pengeluaran','index'=>$i])
	@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi','array'=>true,'index'=>$i])
	<div class="form-group"><label class="col-lg-2 control-label"></label><div class="col-sm-6"><button class="hapus-btn btn btn-danger btn-flat">Hapus</button></div></div>
</div>
	@endfor
	@endif
</div>
@include('input_readonly',['id'=>'total_gaji','label'=>'Total Gaji'])
@endsection

@include('import-datepicker')
@push('script')
<script>
	$(document).ready(function(){
		$('#cek-gaji-btn').on('click', function(e){
			$('#cek-gaji-view').html('<div class="alert alert-info">Memproses</div>');
			var karyawan = $('#id_karyawan').val();
			var tanggal_dari = $('#tanggal_dari').val();
			var tanggal_sampai = $('#tanggal_sampai').val();
			e.preventDefault();
			$.ajax({
				url : '{{ url('gaji/cek') }}?karyawan='+karyawan+'&tanggal_dari='+tanggal_dari+'&tanggal_sampai='+tanggal_sampai,
				success : function(response, status){
					$('#cek-gaji-view').html(response);
				}
			})
		});
		$('#batal-btn').on('click', function(e){
			e.preventDefault();
			$('#cek-gaji-view').html('');
		});
		$('#tambah-pengeluaran-btn').on('click', function(e){
			e.preventDefault();
			var hapusTemplate = '<div class="form-group"><label class="col-lg-2 control-label"></label><div class="col-sm-6"><button class="hapus-btn btn btn-danger btn-flat">Hapus</button></div></div>';
			var pengeluaranTemplate = '<div id="siap-hapus">'+$('#pengeluaran-template').html()+hapusTemplate+'</div>';
			var pengeluaranTambahan = $('#pengeluaran-tambahan').html();
			if(pengeluaranTambahan){
				$('#pengeluaran-tambahan').append(pengeluaranTemplate);
			}else{
				$('#pengeluaran-tambahan').html(pengeluaranTemplate);
			}
			initHapus();
		});

		function initHapus() {
			$('.hapus-btn').on('click', function(e) {
				e.preventDefault();
				$(this).parents('#siap-hapus').remove();
			});
		}

		$('#hitung-gaji-btn').on('click', function(e){
			e.preventDefault();
			if($('#gaji_pokok').length > 0){
				var gaji_pokok = $('#gaji_pokok').length > 0 ? Number($('#gaji_pokok').val()) : 0;
				var jumlah_jam = $('#jumlah_jam').length > 0 ? Number($('#jumlah_jam').val()) : 0;
				var total_uang_makan = $('#total_uang_makan').length > 0 ? Number($('#total_uang_makan').val()) : 0;
				var total_insentif = $('#total_insentif').length > 0 ? Number($('#total_insentif').val()) : 0;
				var total_lembur = $('#total_lembur').length > 0 ? Number($('#total_lembur').val()) : 0;
				var totalPengeluaran = 0;
				$('[name="pengeluaran[]"]').each(function(){
					totalPengeluaran += Number($(this).val());
				});
				var totalGaji =  gaji_pokok + jumlah_jam + total_uang_makan + total_insentif + total_lembur - totalPengeluaran;
				$('#total_gaji').val(totalGaji);
			}else{
				alert('silakan tekan cek gaji terlebih dahulu!')
			}
		});

		@if(!$errors->has('gaji_pokok') && count($errors->all()) > 0)
		$('#cek-gaji-btn').trigger('click');
		@endif

		@if(count(old('pengeluaran')) > 1)
		initHapus();
		@endif

	});
</script>
@endpush
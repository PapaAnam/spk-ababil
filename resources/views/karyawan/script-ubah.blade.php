@push('script')
<script>
	$(document).ready(function(){
		$('select#jenis').on('change', function(){
			var jenis = $(this).val();
			if(jenis){
				if(jenis == 'Operator'){
					$('#rate_per_jam').parent().parent().show();
					$('#insentif').parent().parent().fadeOut();
					$('#operator-area').fadeIn();
					$('#sopir-area').fadeOut();
				}else if(jenis == 'Sopir'){
					$('#rate_per_jam').parent().parent().fadeOut();
					$('#insentif').parent().parent().show();
					$('#operator-area').fadeOut();
					$('#sopir-area').fadeIn();
				}else{
					$('#rate_per_jam').parent().parent().fadeOut();
					$('#insentif').parent().parent().fadeOut();
					$('#operator-area').fadeOut();
					$('#sopir-area').fadeOut();
				}
				$('#rate_per_jam').val(0);
				$('#insentif').val(0);
			}else{
				alert('Pilih salah satu jenis karyawan terlebih dahulu!!!');
			}
		});
		// $('#rate_per_jam').parent().parent().fadeOut();
		// $('#insentif').parent().parent().fadeOut();
		// $('#rate_per_jam').val(0);
		// $('#insentif').val(0);
		$('#tombol-tambah-ot').on('click',function(e){
			e.preventDefault();
			var templateOt = '<div id="operator-tambahan-item"><input type="hidden" name="id_overtime[]"><div class="form-group"><label for="nama_overtime" class="col-lg-2 control-label">Nama Overtime</label><div class="col-sm-6"><input name="nama_overtime[]" type="text" class="form-control" id="nama_overtime" placeholder="Nama Overtime" value=""></div></div><div class="form-group"><label for="rate_overtime" class="col-lg-2 control-label">Rate Overtime</label><div class="col-sm-6"><input name="rate_overtime[]" type="number" class="form-control" id="rate_overtime" placeholder="Rate Overtime" value=""></div></div><div class="form-group"><label for="" class="col-lg-2 control-label"></label><div class="col-sm-6"><a href="#" class="tombol-hapus-ot btn btn-danger btn-flat">Hapus</a></div></div></div><hr>';
			$('#operator-tambahan').append(templateOt);
			initHapusOtEvent();
		});

		function initHapusOtEvent() {
			$('.tombol-hapus-ot').on('click', function(e){
				e.preventDefault();
				$(this).parent().parent().parent().remove();
			});
		}

		$('#tombol-tambah-insentif').on('click',function(e){
			e.preventDefault();
			var templateInsentif = '<div id="operator-tambahan-item"><input type="hidden" name="id_insentif[]"><div class="form-group"><label for="nama_insentif" class="col-lg-2 control-label">Nama Insentif</label><div class="col-sm-6"><input name="nama_insentif[]" type="text" class="form-control" id="nama_insentif" placeholder="Nama Insentif" value=""></div></div>	<div class="form-group"><label for="insentif" class="col-lg-2 control-label">Insentif</label><div class="col-sm-6"><input name="insentif[]" type="number" class="form-control" id="insentif" placeholder="Insentif" value=""></div></div>	<div class="form-group"><label for="lembur" class="col-lg-2 control-label">Lembur</label><div class="col-sm-6"><input name="lembur[]" type="number" class="form-control" id="lembur" placeholder="Lembur" value=""></div></div><div class="form-group"><label for="" class="col-lg-2 control-label"></label><div class="col-sm-6"><a href="#" class="tombol-hapus-insentif btn btn-danger btn-flat">Hapus</a></div></div></div>';
			$('#sopir-tambahan').append(templateInsentif);
			initHapusInsentifEvent();
		});

		function initHapusInsentifEvent() {
			$('.tombol-hapus-insentif').on('click', function(e){
				e.preventDefault();
				$(this).parent().parent().parent().remove();
			});
		}
		@if($d->jenis != 'Sopir')
		// $('#insentif').parent().parent().fadeOut();
		// $('#insentif').val(0);
		$('#sopir-area').fadeOut();
		@endif
		@if($d->jenis != 'Operator')
		// $('#rate_per_jam').parent().parent().fadeOut();
		// $('#rate_per_jam').val(0);
		$('#operator-area').fadeOut();
		@endif
		initHapusOtEvent();
		initHapusInsentifEvent();
	});
</script>
@endpush


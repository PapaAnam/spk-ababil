@push('script')
<script>
	$(document).ready(function(){
		$('select#jenis').on('change', function(){
			var jenis = $(this).val();
			if(jenis){
				if(jenis == 'Operator'){
					$('#rate_per_jam').parent().parent().show();
					$('#insentif').parent().parent().fadeOut();
				}else if(jenis == 'Sopir'){
					$('#rate_per_jam').parent().parent().fadeOut();
					$('#insentif').parent().parent().show();
				}else{
					$('#rate_per_jam').parent().parent().fadeOut();
					$('#insentif').parent().parent().fadeOut();
				}
				$('#rate_per_jam').val(0);
				$('#insentif').val(0);
			}else{
				alert('Pilih salah satu jenis karyawan terlebih dahulu!!!');
			}
		});
		$('#rate_per_jam').parent().parent().fadeOut();
		$('#insentif').parent().parent().fadeOut();
		$('#rate_per_jam').val(0);
		$('#insentif').val(0);
	});
</script>
@endpush
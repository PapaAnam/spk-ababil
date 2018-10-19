@push('script')
	<script>
		$(document).ready(function(){
			$('#check_all').on('ifChecked', function(e){
				$('.minimal').iCheck('check');
			});
			$('#check_all').on('ifUnchecked', function(e){
				$('.minimal').iCheck('uncheck');
			});
		});
	</script>
@endpush
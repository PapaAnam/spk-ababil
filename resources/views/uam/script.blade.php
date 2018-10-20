@push('script')
<script>
	$(document).ready(function(){
		var semuaId = {{$roles->pluck('id')->toJson()}};
		$('#role').on('change', function(){
			for (var i of semuaId) {
				$('#role-'+i).fadeOut();
			}
			var id = $(this).val();
			$('#role-'+id).fadeIn();
		});
		$('#role').trigger('change');
	});
</script>
@endpush
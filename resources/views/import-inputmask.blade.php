{{-- @push('css')
<link rel="stylesheet" href="{{ asset('plugins/input-mask/bootstrap-timepicker.min.css') }}">
@endpush --}}

@push('js')
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
@endpush

@push('script')
<script>
	$(function(){
		$("[data-mask]").inputmask();
	});
</script>
@endpush

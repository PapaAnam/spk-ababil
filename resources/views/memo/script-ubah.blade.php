@push('script')
<script>
	$(document).ready(function(){
		$('#id_karyawan').on('change', function(){
			$('#tambahan').empty();
			$('#tambahan').html('<div class="form-group"><label for="insentif" class="col-lg-2 control-label"></label><div class="col-sm-6"><h4 class="badge badge-info">Tunggu Sebentar</h4></div></div>')
			$.ajax({
				type : "GET",
				url : '{{url('api/karyawan')}}?id='+$(this).val(),
				success:function(res,status){
					$('#tambahan').empty();
					var jenis = res.jenis;
					if(jenis == 'Sopir'){
						tambahanSopir(res);
					}else if(jenis == 'Operator'){
						tambahanOperator(res);
					}
				}
			})
		});

		function tambahanSopir(res) {
			var ins = res.insentifdetail;
			if(ins.length > 0){
				var a = 1;
				var err = [];
				@if( count($errors->all()) > 0 && old('insentif') ) 
				err = [
				@foreach(old('insentif') as $ins)
				{
					insentif : {{$ins?$ins:'null'}},
					lembur : {{old('lembur')[$loop->index] ? old('lembur')[$loop->index] : 'null'}},
				},
				@endforeach
				];
				@endif
				for (var i of res.insentifdetail) {
					@if(count($errors->all()) > 0)
					var html = '<input type="hidden" data-id="'+i.id+'" name="id_insentif[]" value="'+i.id+'"><div class="form-group"><label for="insentif" class="col-lg-2 control-label">'+i.nama+'</label><div class="col-sm-6"><input value="{!! '\'+err[a-1][\'insentif\']+\'' !!}" name="insentif[]" type="number" class="form-control" id="insentif" placeholder="Qty '+i.nama+'" value=""></div></div><div class="form-group"><label for="lembur" class="col-lg-2 control-label">Lembur '+a+'</label><div class="col-sm-6"><input value="{!! '\'+err[a-1][\'lembur\']+\'' !!}" name="lembur[]" type="number" class="form-control" id="lembur" placeholder="Qty Lembur '+a+'" value=""></div></div><hr>';
					@else
					var html = '<input type="hidden" data-id="'+i.id+'" name="id_insentif[]" value="'+i.id+'"><div class="form-group"><label for="insentif" class="col-lg-2 control-label">'+i.nama+'</label><div class="col-sm-6"><input data-insentif="'+i.id+'" name="insentif[]" type="number" class="form-control" id="insentif" placeholder="Qty '+i.nama+'" value=""></div></div><div class="form-group"><label for="lembur" class="col-lg-2 control-label">Lembur '+a+'</label><div class="col-sm-6"><input data-lembur="'+i.id+'" name="lembur[]" type="number" class="form-control" id="lembur" placeholder="Qty Lembur '+a+'" value=""></div></div><hr>';
					@endif
					$("#tambahan").append(html);
					a++;
					$.ajax({
						url : '{{url('api/insentif')}}?id_insentif='+i.id+'&id_timesheet='+{{$d->id}},
						success:function(res,status){
							$('[data-id='+res.id_insentif+']').parent().find('[data-insentif='+res.id_insentif+']').val(res.qty);
							$('[data-id='+res.id_insentif+']').parent().find('[data-lembur='+res.id_insentif+']').val(res.qty_lembur);
						}
					})
				}
				$("#tambahan").prepend('<hr>');
			}
		}

		function tambahanOperator(res) {
			var ins = res.overtime;
			if(ins.length > 0){
				var a = 1;
				var err = [];
				@if( count($errors->all()) > 0 && old('overtime') ) 
				err = [
				@foreach(old('overtime') as $overtime)
				'{{$overtime}}',
				@endforeach
				];
				@endif
				for (var i of res.overtime) {
					@if(count($errors->all()) > 0)
					var html = '<div class="form-group"><label for="insentif" class="col-lg-2 control-label">'+i.nama+'</label><div class="col-sm-6"><input type="hidden" name="id_overtime[]" value="'+i.id+'"><select name="overtime[]" id="overtime" class="form-control"><option '+(err[a-1] == 'Ya' ? 'selected="selected"' : '')+ ' value="Ya">Ya</option><option value="Tidak" '+(err[a-1] == 'Tidak' ? 'selected="selected"' : '')+'>Tidak</option></select></div></div><hr>';
					@else
					var html = '<div class="form-group"><label for="insentif" class="col-lg-2 control-label">'+i.nama+'</label><div class="col-sm-6"><input type="hidden" name="id_overtime[]" value="'+i.id+'"><select name="overtime[]" id="overtime" class="form-control"><option value="Ya">Ya</option><option selected="selected" value="Tidak">Tidak</option></select></div></div><hr>';
					@endif
					$("#tambahan").append(html);
					a++;
				}
				$("#tambahan").prepend('<hr>');
			}
		}

		$('#id_karyawan').trigger('change');
	});
</script>
@endpush

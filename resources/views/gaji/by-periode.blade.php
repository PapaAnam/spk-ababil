@extends('gaji.index')
@section('filter')
<div class="col-md-12">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Lihat berdasarkan periode</h3>
		</div>
		<div class="box-body">
			<form method="get" action="" class="form-horizontal">
				@include('datepicker', ['size'=>10, 'id'=>'tanggal_dari','label'=>'Dari','required'=>true,'value'=>request()->query('tanggal_dari')])
				@include('datepicker', ['size'=>10, 'id'=>'tanggal_sampai','label'=>'Sampai','required'=>true,'value'=>request()->query('tanggal_sampai')])
				<div class="form-group">
					<label class="col-lg-2 control-label"></label>
					<div class="col-sm-6">
						<button type="submit" class="btn btn-primary btn-flat">Lihat</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
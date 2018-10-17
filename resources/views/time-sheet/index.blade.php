@extends('time-sheet.layout')
@section('filter')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Lihat berdasarkan karyawan</h3>
			</div>
			<div class="box-body">
				<form method="get" action="" class="form-horizontal">
					@include('select2-no-tags', ['labelSize'=>3,'selectSize'=>8,'id'=>'karyawan','selectData'=>$listKaryawan,'label'=>'Pilih Karyawan','selected'=>request()->query('karyawan')])
					<div class="form-group">
						<label class="col-lg-3 control-label"></label>
						<div class="col-sm-6">
							<button type="submit" class="btn btn-primary btn-flat">Lihat</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Lihat berdasarkan rentang waktu</h3>
			</div>
			<div class="box-body">
				<form method="get" action="" class="form-horizontal">
					<div class="row">
						<div class="col-md-6">
							@include('datepicker', ['labelSize'=>3,'size'=>9,'id'=>'dari','label'=>'Dari','required'=>true,'value'=>request()->query('dari')])
						</div>
						<div class="col-md-6">
							@include('datepicker', ['labelSize'=>3,'size'=>9,'id'=>'sampai','label'=>'Sampai','required'=>true,'value'=>request()->query('sampai')])
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-lg-3 control-label"></label>
								<div class="col-sm-6">
									<button type="submit" class="btn btn-primary btn-flat">Lihat</button>
								</div>
							</div>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@include('import-datepicker')
@include('import-select2')
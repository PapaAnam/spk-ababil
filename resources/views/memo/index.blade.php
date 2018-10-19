@extends('memo.layout')
@section('filter')
<div class="row">
	<div class="col-md-6">
		<div class="box-group" id="accordion">
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							Lihat berdasarkan klien
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse {{request()->query('klien')?'in':''}}">
					<div class="box-body">
						<form method="get" action="" class="form-horizontal">
							@include('select2-no-tags', ['labelSize'=>3,'selectSize'=>8,'id'=>'klien','selectData'=>$listKlien,'label'=>'Pilih Klien','selected'=>request()->query('klien')])
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
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							Lihat berdasarkan proyek
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse {{request()->query('proyek')?'in':''}}">
					<div class="box-body">
						<form method="get" action="" class="form-horizontal">
							@include('select2-no-tags', ['labelSize'=>3,'selectSize'=>8,'id'=>'proyek','selectData'=>$listProyek,'label'=>'Pilih Proyek','selected'=>request()->query('proyek')])
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
		</div>
	</div>
	<div class="col-md-6">
		<div class="box-group">
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
							Lihat berdasarkan rentang waktu
						</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse {{request()->query('dari')&&request()->query('sampai')?'in':''}}">
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
	</div>
</div>
@endsection

@include('import-datepicker')
@include('import-select2')
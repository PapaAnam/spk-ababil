@extends('progress.tugas')

@section('other')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Line Chart</h3>
	</div>
	<div class="box-body">
		<div class="chart">
			<canvas id="lineChart" style="height:250px"></canvas>
		</div>
	</div>
</div>
@endsection

@push('script')
<script>
	$(document).ready(function(){
		var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
		var lineChart = new Chart(lineChartCanvas);
		var areaChartData = {
			labels: {!!$charts->transform(function($item){$item->tglprogress = tglIndo($item->tanggal) . ' [ '.$item->progress.' '.$item->nama_satuan.' ]'; return $item;})->pluck('tglprogress')->toJson()!!},
			datasets: [
			{
				label: "Electronics",
				fillColor: "rgba(150, 100, 40, 1)",
				strokeColor: "#E78A38",
				pointColor: "rgba(210, 214, 222, 1)",
				pointStrokeColor: "#c1c7d1",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: 
				@php
					$total = 0;
					$lineData = [];
				@endphp
				@foreach ($charts as $c)
					@php
						$total += $c->progress;
						$lineData[] = $total;
					@endphp
				@endforeach
				{{collect($lineData)->toJson()}}
			}
			]
		};
		var areaChartOptions = {
			//Boolean - If we should show the scale at all
			showScale: true,
			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: false,
			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",
			//Number - Width of the grid lines
			scaleGridLineWidth: 2,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - Whether the line is curved between points
			bezierCurve: true,
			//Number - Tension of the bezier curve between points
			bezierCurveTension: 0.3,
			//Boolean - Whether to show a dot for each point
			pointDot: true,
			//Number - Radius of each point dot in pixels
			pointDotRadius: 6,
			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth: 1,
			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius: 20,
			//Boolean - Whether to show a stroke for datasets
			datasetStroke: true,
			//Number - Pixel width of dataset stroke
			datasetStrokeWidth: 2,
			//Boolean - Whether to fill the dataset with a color
			datasetFill: true,
			//String - A legend template
			legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
			//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true
		};
		var lineChartOptions = areaChartOptions;
		lineChartOptions.datasetFill = false;
		lineChart.Line(areaChartData, lineChartOptions);
	});
</script>
@endpush

@include('import-chart')
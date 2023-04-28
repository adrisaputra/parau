<html>
<head>
	<title>INVOICE CLIENT</title>
</head>
<style type="text/css">
		/* table tr td,
		table tr th{
			font-size: 9pt;
		} */
		table {
			border-collapse: collapse;
			border-spacing: 0;
			}
		table {
		background-color: transparent;
		}
		table col[class*="col-"] {
		position: static;
		display: table-column;
		float: none;
		}
		table td[class*="col-"],
		table th[class*="col-"] {
		position: static;
		display: table-cell;
		float: none;
		}
		.table {
		width: 100%;
		max-width: 100%;
		margin-bottom: 20px;
		}
		.table > thead > tr > th,
		.table > tbody > tr > th,
		.table > tfoot > tr > th,
		.table > thead > tr > td,
		.table > tbody > tr > td,
		.table > tfoot > tr > td {
		padding: 3px;
		line-height: 1.42857143;
		vertical-align: top;
		border-top: 1px solid #ddd;
		}
		.table > tbody + tbody {
		border-top: 2px solid #ddd;
		}
		.table .table {
		background-color: #fff;
		}
		
		.table-bordered {
		border: 1px solid #ddd;
		}
		
		.table-striped > tbody > tr:nth-of-type(odd) {
		background-color: #f9f9f9;
		}
		.table-bordered > thead > tr > th,
		.table-bordered > tbody > tr > th,
		.table-bordered > tfoot > tr > th,
		.table-bordered > thead > tr > td,
		.table-bordered > tbody > tr > td,
		.table-bordered > tfoot > tr > td {
		/* border: 1px solid #f4f4f4; */
		border: 1px solid #e1e1e1;
		}
		html {
			font-family: sans-serif;
		-ms-text-size-adjust: 100%;
		-webkit-text-size-adjust: 100%;
		}
	</style>
	<style>
		.page-break {
		page-break-after: always;
		}
		.page-break2 {
		page-break-after: avoid;
		}
	</style>
<body>
	
	<table class="table table-bordered">
		<tr style="background-color: #2196f3;color:white">
			<th style="width: 200px;text-align:center;font-size:12px" colspan=7>INVOICE CLIENT</th>
		</tr>
		<tr style="background-color: gray;color:white">
			<th style="font-size:12px;">Nama Client</th>
			<th style="font-size:12px;">Nama Jasa Pekerjaan</th>
			<th style="font-size:12px;">Tanggal Mulai</th>
			<th style="font-size:12px;">Tanggal Selesai</th>
			<th style="font-size:12px;">Volume Pekerjaan</th>
			<th style="font-size:12px;">Harga</th>
			<th style="width: 20%;font-size:12px;">Jumlah</th>
		</tr>
		<tr>
			<td style="font-size:12px;" rowspan={{ $project->project_detail->count() }}>{{ $project->client_name }}</td>
			@foreach($project->project_detail as $n => $v)
				@if($n == 0)
					<td style="font-size:12px;">
						{{ $v->work_name }}
					</td>
					<td style="font-size:12px;">
						<center>{{ date('d-m-Y', strtotime($v->work_start)) }}
					</td>
					<td style="font-size:12px;">
						<center>{{ date('d-m-Y', strtotime($v->work_end)) }}
					</td>
					<td style="font-size:12px;">
						<center>{{ $v->volume }}
					</td>
					<td style="font-size:12px;">
						<center>{{ number_format($v->service_value, 0, ',', '.') }}
					</td>
					<td style="font-size:12px;">
						<center>{{ number_format(($v->service_value*$v->volume), 0, ',', '.') }}
					</td>
				@endif
			@endforeach
		</tr>
		@foreach($project->project_detail as $n => $v)
			@if($n > 0)
			<tr>
				<td style="font-size:12px;">
					{{ $v->work_name }}
				</td>
				<td style="font-size:12px;">
					<center>{{ date('d-m-Y', strtotime($v->work_start)) }}
				</td>
				<td style="font-size:12px;">
					<center>{{ date('d-m-Y', strtotime($v->work_end)) }}
				</td>
				<td style="font-size:12px;">
					<center>{{ $v->volume }}
				</td>
				<td style="font-size:12px;">
					<center>{{ number_format($v->service_value, 0, ',', '.') }}
				</td>
				<td style="font-size:12px;">
					<center>{{ number_format(($v->service_value*$v->volume), 0, ',', '.') }}<center>
				</td>
			</tr>
			@endif
		@endforeach
		
		<tr>
			<th style="font-size:12px;" colspan='6'>SUB TOTAL</th>
			@php $total = 0 ;$jumlah=0;@endphp
			@foreach($project->project_detail as $v)
				@php $jumlah = $v->service_value*$v->volume; @endphp
				@php $total = $total + $jumlah; @endphp
			@endforeach
			<th style="font-size:12px;">{{ number_format($total, 0, ',', '.') }}</th>
		</tr>
		<tr>
			<th style="font-size:12px;" colspan='6'>DISKON</th>
			<th style="font-size:12px;">{{ number_format($project->discount, 0, ',', '.') }}</th>
		</tr>
		<tr>
			<th style="font-size:12px;" colspan='6'>TOTAL</th>
			<th style="font-size:12px;">{{ number_format($total-$project->discount, 0, ',', '.') }}</th>
		</tr>
	</table>

</body>
</html>
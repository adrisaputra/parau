<html>
<head>
	<title>PARAU.ID</title>
</head>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
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
		border: 1px solid #ffffff;
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
	
<center><p>PARAU.ID</p></center>
		
<div class="row">
	<div class="col s3 m3 l3">
		Alamat Outlet 
	</div>
	<div class="col s8 m8 l8">
		: {{ $sellingTransaction->user->outlet->outlet_name }}
	</div>
	<div class="col s3 m3 l3">
		Telp 
	</div>
	<div class="col s8 m8 l8">
		: {{ $sellingTransaction->user->outlet->phone }}
	</div>
</div>
<hr style="margin-top: -15px;">		
<div class="row">
	<div class="col s10 m10 l10">
		{{ $sellingTransaction->created_at->format('D, d-m-Y') }}
	</div>
	<div class="col s2 m2 l2" style="text-align: right;">
		{{ $sellingTransaction->user->name }}
	</div>
	<div class="col s12 m12 l12">
		{{ $sellingTransaction->created_at->format('H:i') }}
	</div>
	<div class="col s12 m12 l12">
		{{ $sellingTransaction->transaction_number }}
	</div>
</div>
	<table class="table table-bordered" style="width : 100%; padding-top: -10px; height: 10px" >
		<tr>
			<td style="border-top: 1px solid #8bc34a;"></td>
			<td style="border-top: 1px solid #8bc34a;"></td>
		</tr>
		@foreach($sellingDetail as $v)
		<tr>
			<td><b>{{ $v->product->product_name }} </b><br>{{ number_format($v->amount, 0, ',', '.') }} &nbsp;&nbsp;&nbsp;x &nbsp;&nbsp;&nbsp;{{ number_format($v->product->selling_price, 0, ',', '.') }}</td>
			<td style="padding-top: 15px;text-align: right;">{{ number_format($v->amount * $v->product->selling_price, 0, ',', '.') }}</td>
		</tr>
		@endforeach
		<tr>
			<td style="border-bottom: 1px solid #8bc34a;"></td>
			<td style="padding-top: 15px;text-align: right;border-bottom: 1px solid #8bc34a;"></td>
		</tr>
		<tr>
			<td><b>Total </b></td>
			<td style="text-align: right;">{{ number_format($sellingTransaction->total_price, 0, ',', '.') }}</td>
		</tr>
		<tr>
			<td><b>Bayar </b></td>
			<td style="text-align: right;">{{ number_format($sellingTransaction->pay_cost, 0, ',', '.') }}</td>
		</tr>
		<tr>
			<td><b>Kembali </b></td>
			<td style="text-align: right;">{{ number_format($sellingTransaction->pay_cost - $sellingTransaction->total_price, 0, ',', '.') }}</td>
		</tr>
	</table>


</body>
<script>
	window.onload=function(){self.print();}
</script>
	<script>setTimeout(function(){ window.location.href = '{{url("/cashier/create")}}'; }, 100);</script>
</html>
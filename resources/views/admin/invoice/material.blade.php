<html>
<head>
	<title>INVOICE PEMBAYARAN TUKANG</title>
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
			<th style="width: 200px;text-align:center;font-size:12px" colspan=5>INVOICE PEMBELIAN MATERIAL</th>
		</tr>
		<tr style="background-color: gray;color:white">
			<th style="font-size:12px;">Nama Toko</th>
			<th style="font-size:12px;">Tanggal</th>
			<th style="font-size:12px;">Nama Barang</th>
			<th style="font-size:12px;">Harga</th>
			<th style="font-size:12px;">Jumlah</th>
		</tr>
		@foreach($material as $v)
			<tr>
				<td style="font-size:12px;">
					<center>{{ $v->outlet_name }}
				</td>
				<td style="font-size:12px;">
					<center>{{ date('d-m-Y', strtotime($v->date)) }}
				</td>
				<td style="font-size:12px;">
					<center>{{ $v->product_name }}
				</td>
				<td style="font-size:12px;">
					<center>{{ number_format($v->price, 0, ',', '.') }}
				</td>
				<td style="font-size:12px;">
					<center>{{ $v->amount }}
				</td>
			</tr>
		@endforeach
	</table>

</body>
</html>
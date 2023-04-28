@extends('admin.layout')

@section('style')
<style>
	#detail-state td,
	#detail-state tr {
		border: none;
	}

	#detail-state tr:nth-child(2) {
		font-size: 20px;
		font-weight: bold;
	}
</style>
@endsection

@section('konten')

<!-- BEGIN: Page Main-->
<div id="main">
	<div class="row">
		<div class="content-wrapper-before gradient-45deg-light-blue-cyan"></div>
		<div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
			<!-- Search for small screen-->
			<div class="container">
				<div class="row">
					<div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ __($title) }}</span></h5>
						<ol class="breadcrumbs mb-0">
							<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item active">{{ __($title) }}
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<form action="{{ url('/'.Request::segment(1).'/confirm/'.$purchaseTransaction->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
			{{ csrf_field() }}
			<input readonly type="hidden" name="_method" value="PUT">

			<div class="col s12">
				<div class="container">
					<div class="section">
						<!-- Input Fields -->
						<div class="row">
							<div class="col s12">
								<div id="input-fields" class="card card-tabs">
									<div class="card-content">

										<div id="view-input-fields">
											<div class="row">

												<div class="col s12" style="overflow-x:auto;">
													<table class="highlight" id="detail-state">
														<tr>
															<td>Nomor Transaksi :</td>
															<td>Supplier :</td>
															<td>Tanggal Transaksi :</td>
														</tr>
														<tr>
															<td>{{ $purchaseTransaction->transaction_number }}</td>
															<td>{{ $purchaseTransaction->supplier->supplier_name }}</td>
															<td>{{ $purchaseTransaction->updated_at }}</td>
														</tr>
													</table>
												</div>

												@php $total_belanja = 0; @endphp
												<div class="col s12" style="overflow-x:auto;">
													<table class="highlight">
														<thead>
															<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
																<th style="width: 60px">No</th>
																<th>Nama Barang</th>
																<th>Jumlah Beli</th>
																<th>Harga Beli (Rp.)</th>
																{{-- <th>Harga Jual</th>
																<th>Profit</th> --}}
																<th>Sub Total Harga (Rp.)</th>
															</tr>
														</thead>
														<tbody>
															@foreach ($purchaseDetail as $row)
															@php $i = $loop->iteration; @endphp
															@php $total_belanja = $total_belanja + ($row->product->purchase_price * $row->amount); @endphp
															<tr role="row" class="odd">
																<td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td>
																<td>{{ $row->product->product_name }}</td>
																<td>{{ $row->amount }}</td>
																<td>{{ number_format($row->price / $row->amount, 0, ',', '.') }}</td>
																{{-- <td></td>
																<td></td> --}}
																<td>{{ number_format($row->price, 0, ',', '.') }}</td>
																{{-- <td>{{ number_format($row->total_price, 0, ',', '.') }}</td> --}}
															</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
																<th colspan="4">TOTAL BELANJA (Rp.)</th>
																<th>{{ number_format($total_belanja, 0, ',', '.') }}</th>
															</tr>
														</tfoot>
													</table>
													{{-- <div class="float-right">{{ $purchaseTransaction->appends(Request::only('search'))->links() }}</div> --}}
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
					<a href="{{ url()->previous() }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
				</div>
			</div>
		</form>
		<div class="content-overlay"></div>
	</div>
</div>
</div>
<!-- END: Page Main-->

@endsection
@extends('admin.layout')

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
			<input type="hidden" name="_method" value="PUT">

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
												<p style="text-align:center;font-size:20px;font-weight:bold">{{ __($title) }}</p>
												<input type="hidden" min="0" id="" name="purchase_transaction_id" value="{{ $purchaseTransaction->id }}" style="@if ($errors->has('product_id{{$item->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif" readonly>
												<br><br>
												@php $total_belanja = 0; @endphp

												@foreach ($purchaseDetail as $item)
												@php $total_belanja = $total_belanja + ($item->product->purchase_price * $item->amount); @endphp
												<div class="col s12 confirm-cart" style="margin-bottom:3rem;" id="detail-{{$item->id}}">

													<p style="font-size:30px;font-weight:bold;margin: 0 0 1rem 1rem;">{{ $item->product->product_name }}</p>
													<input type="hidden" min="0" id="" name="id[]" value="{{ $item->id }}" style="@if ($errors->has('product_id{{$item->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif" readonly>
													<input type="hidden" min="0" id="" name="product_id[]" value="{{ $item->product->id }}" style="@if ($errors->has('product_id{{$item->product->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif" readonly>
													<div class="col s3">
														<img src="{{asset('/upload/product/dummy-img.png')}}" alt="" style="border: 1px #e3e3e3 solid; border-radius:10px" width="100%">
													</div>

													<div class="col s4">
														<div class="col s12 mb-5">
															<label for="amount">{{ __('Jumlah Produk Diterima') }}</label>
															<input type="number" min="0" id="amount" name="amount[]" value="{{ $item->amount }}" style="@if ($errors->has('amount{{$item->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
															@if ($errors->has('amount{{$item->id}}'))<small>
																<div class="error">{{ $errors->first('amount'.$item->id) }}</div>
															</small>@endif
														</div>
														<div class="col s12 mb-5">
															<label for="purchase_price">{{ __('Harga Beli Satuan (Rp.)') }}</label>
															<input type="number" min="0" id="purchase_price" name="purchase_price[]" value="{{ $item->product->purchase_price }}" style="@if ($errors->has('purchase_price{{$item->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
															@if ($errors->has('purchase_price{{$item->id}}'))<small>
																<div class="error">{{ $errors->first('purchase_price'.$item->id) }}</div>
															</small>@endif
														</div>
														<div class="col s12 mb-5 p-0">
															<div class="col s8 selling-class">
																<label for="selling_price">{{ __('Harga Jual Satuan (Rp.)') }}</label>
																<input type="number" min="0" id="selling_price" name="selling_price[]" value="{{ $item->product->selling_price }}" style="@if ($errors->has('selling_price{{$item->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
																@if ($errors->has('selling_price{{$item->id}}'))<small>
																	<div class="error">{{ $errors->first('selling_price'.$item->id) }}</div>
																</small>@endif
															</div>
															<div class="col s4">
																<label for="profit">{{ __('Untung (%)') }}</label>
																@php $untung = ($item->product->selling_price - $item->product->purchase_price) / $item->product->purchase_price * 100; @endphp
																<input type="number" min="0" step="0.01" id="profit" name="profit[]" value="{{ $untung  }}" style="@if ($errors->has('profit{{$item->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
																@if ($errors->has('profit{{$item->id}}'))<small>
																	<div class="error">{{ $errors->first('profit'.$item->id) }}</div>
																</small>@endif
															</div>
														</div>
													</div>

													<div class="col s4 mb-5 p-0">
														<p style="font-size:20px;font-weight:bold;margin: 0 0 1rem 1rem;">Sub Total Harga</p>
														<p style="font-size:40px;font-weight:bold;margin: 0 0 1rem 1rem;">Rp. <span id="sub-total-price-out">{{ number_format($item->product->purchase_price * $item->amount, 2,',','.') }}</span></p>
														<input type="hidden" class="sub-total-price" id="sub-total-price" value="{{ $item->product->purchase_price * $item->amount }}" style="@if ($errors->has('total-price{{$item->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">

														<p style="margin: 5rem 0 1rem 1rem;">
															<label>
																<input type="checkbox" required />
																<span style="font-size:30px;font-weight:bold;color:#2196f3">Konfirmasi</span>
															</label>
														</p>
													</div>
													
												</div>
												@endforeach
												<div class="col s12 mb-3" style="border: 1px #e3e3e3 solid; "></div>
												<div class="col s12" style="text-align: right; padding-right:10rem;">
													<p style="font-size:40px;font-weight:bold;margin: 0 0 1rem 1rem;">Total Belanja : </p>
													<span style="font-size:60px;font-weight:bold;margin: 0 0 1rem 1rem; color:#2196f3">Rp. <span id="total-price">{{ number_format($total_belanja, 2,',','.') }}</span></span>
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
					<button type="submit" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">save</i></button>
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

@section('script')

<script>
	// DETECT ALL INPUT CHANGES
	
	$('.confirm-cart input').on("input", function() {

		// GET THIS DETAIL ID
		var detail_id = '#' + $(this).closest('.confirm-cart').attr('id');

		console.log();

		// GET INPUT VALUE
		var amount = parseFloat($(detail_id + " #amount").val());
		var purchase_price = parseFloat($(detail_id + " #purchase_price").val());
		var profit = parseFloat($(detail_id + " #profit").val());
		var selling_price = parseFloat($(detail_id + " #selling_price").val());
		
		// COUNT TOTAL PRICE
		var sub_total_price = amount * purchase_price;
		
		// DOCUMENT PUSH
		$(detail_id + " #sub-total-price-out").html(sub_total_price.toLocaleString('id-ID', {minimumFractionDigits: 2}));
		$(detail_id + " #sub-total-price").val(sub_total_price);
		
		// DOCUMENT PUSH
		// if input is not in selling price
		if($(this).attr('id') == 'selling_price'){
			profit = Math.round(((selling_price - purchase_price) / purchase_price * 100) * 100) / 100;
			$(detail_id + " #profit").val(profit);
		}
		else{
			selling_price = Math.round(purchase_price * (profit/100 + 1) * 100) / 100;
			$(detail_id + " #selling_price").val(selling_price);
		}
		
		// COUNT TOTAL PRICE
		var total_price = 0;
		var total_price_class = document.getElementsByClassName("sub-total-price");
		for(var i = 0; i < total_price_class.length; i++){
			var value = parseInt(document.getElementsByClassName("sub-total-price")[i].value);
			total_price = total_price + value;
		}
		
		// DOCUMENT PUSH
		$("#total-price").html(total_price.toLocaleString('id-ID', {minimumFractionDigits: 2}));
	});
</script>

@endsection
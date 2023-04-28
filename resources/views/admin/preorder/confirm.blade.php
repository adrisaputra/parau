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
							<li class="breadcrumb-v"><a href="{{ url('/') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-v active">{{ __($title) }}
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
                    <!-- Borderless Table -->
                    <div class="row">
                        <div class="col s12">
                            <div id="borderless-table" class="card card-tabs">
                                <div class="card-content">
                                    <div class="card-title content-right">
							 <input type="hidden" min="0" id="" name="purchase_transaction_id" value="{{ $purchaseTransaction->id }}" style="@if ($errors->has('product_id{{$v->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif" readonly>
                                    </div>
                                    <div id="view-borderless-table ">
                                        <div class="row">

                                            <div class="col s12 " style="overflow-x:auto;">
                                                <table class="highlight animate fadeUp">
                                                    <tbody>@php $total_belanja = 0; @endphp

										  	@foreach ($purchaseDetail as $i => $v)
											@php $total_belanja = $total_belanja + ($v->product->purchase_price * $v->amount); @endphp
											<tr class="confirm-cart" id="detail-{{$v->id}}">
												<input type="hidden" min="0" id="" name="id[]" value="{{ $v->id }}" style="@if ($errors->has('product_id{{$v->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif" readonly>
											 	<input type="hidden" min="0" id="" name="product_id[]" value="{{ $v->product->id }}" style="@if ($errors->has('product_id{{$v->product->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif" readonly>
                                                        
                                                            <td>
													<center>
													{{ $v->product->product_name }}<br>
													@if($v->image)
													<img src="{{ asset('storage/upload/product_image/thumbnail/'.$v->image) }}" class="img-circle" alt="User Image" width="100px" height="100px">
													@else
													<img src="{{ asset('upload/product/dummy-img.png') }}" class="img-circle" alt="User Image" width="100px" height="100px">
													@endif
													</center>
                                                            </td>
                                                            <td>
													<label for="amount">{{ __('Jumlah Produk Diterima') }}</label>
													<input type="number" min="0" id="amount" name="amount[]" value="{{ $v->amount }}" style="@if ($errors->has('amount{{$v->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
													@if ($errors->has('amount{{$v->id}}'))<small><div class="error">{{ $errors->first('amount'.$v->id) }}</div></small>@endif
												</td>
                                                            <td>
													<label for="purchase_price">{{ __('Harga Beli Satuan (Rp.)') }}</label>
													<input type="number" min="0" id="purchase_price" name="purchase_price[]" value="{{ $v->product->purchase_price }}" style="@if ($errors->has('purchase_price{{$v->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
													@if ($errors->has('purchase_price{{$v->id}}'))<small><div class="error">{{ $errors->first('purchase_price'.$v->id) }}</div></small>@endif
												</td>
                                                            <td>
													<label for="selling_price">{{ __('Harga Jual Satuan (Rp.)') }}</label>
													<input type="number" min="0" id="selling_price" name="selling_price[]" value="{{ $v->product->selling_price }}" style="@if ($errors->has('selling_price{{$v->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
													@if ($errors->has('selling_price{{$v->id}}'))<small><div class="error">{{ $errors->first('selling_price'.$v->id) }}</div></small>@endif
												</td>
                                                            <td>
													<label for="profit">{{ __('Untung (%)') }}</label>
													@php $untung = ($v->product->selling_price - $v->product->purchase_price) / $v->product->purchase_price * 100; @endphp
													<input type="text" id="profit" name="profit[]" value="{{ $untung  }}" style="@if ($errors->has('profit{{$v->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
													@if ($errors->has('profit{{$v->id}}'))<small><div class="error">{{ $errors->first('profit'.$v->id) }}</div></small>@endif
												</td>
                                                            <td style="width:20%">
													<center>
													<p style="font-size:20px;font-weight:bold;">Rp. <span id="sub-total-price-out">{{ number_format($v->product->purchase_price * $v->amount, 2,',','.') }}</span></p>
													<input type="hidden" class="sub-total-price" id="sub-total-price" value="{{ $v->product->purchase_price * $v->amount }}" style="@if ($errors->has('total-price{{$v->id}}'))border-bottom: 2px solid #ff5252;@else color: black; @endif">

													
														<label>
															<input type="checkbox" required />
															<span style="font-size:14px;font-weight:bold;color:#2196f3">Konfirmasi</span>
														</label>
													</center>
												</td>
                                                        </tr>
                                                        @endforeach
											 <tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
											 	<td colspan=5><p style="font-size:24px;font-weight:bold;">Total Belanja</p></td>
											 	<td><center><p style="font-size:24px;font-weight:bold;">Rp. <span id="total-price">{{ number_format($total_belanja, 2,',','.') }}</p></center></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="bottom: 40px; right: 19px;" class="fixed-action-btn direction-top">
				<button type="submit" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">save</i></button>
                    <a href="{{ url('/' . Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
                </div>
            </div>
            <div class="content-overlay"></div>
        	</div>
		</form>
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
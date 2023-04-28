<div id="product-modal"> 
	@if($product->image)
		<img src="{{ asset('storage/upload/product_image/thumbnail/'.$product->image) }}" class="img-circle" alt="User Image"  width="100%"  style="height: 200px;background-position: center;background-repeat: no-repeat;background-size: 70%;">
	@else
		<img src="{{ asset('upload/product/dummy-img.png') }}" class="img-circle" alt="User Image" width="100%"  style="height: 200px;background-position: center;background-repeat: no-repeat;background-size: 70%;">
	@endif
	<h4 style="text-align:center">{{ $product->product_name }}</h4>
	
	@php
		$percent = round(($product->inventory->in_stock / $product->inventory->full_stock) * 100);
		$color = 'grey';
		if ($percent < 33) {
			$color = 'red';
			$stok = 'Hampir habis';
		} elseif ($percent < 66) {
			$color = 'orange';
			$stok = 'Menipis';
		} else {
			$color = 'green';
			$stok = 'Aman';
		}
	@endphp
	<div class="progress-group text-left" id="stock-bar">
		<span id="stock-tittle">Stock {{ $stok }}</span>
		<span class="float-right">
			<b id="modal-in-stock">{{ $product->inventory->in_stock }}</b>/
			<span id="modal-full-stock">{{ $product->inventory->full_stock }}</span>
		</span>
			
		<div class="my-progress" style="height: 1rem;">
			<div class="my-progress-bar {{ $color }}" role="progressbar" style="width: {{ $percent }}%; color: white;font-size:8px" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
		</div>		
		<div class="input-field col s12" style="margin-top: 1rem;margin-bottom: 0rem;">
			<label for="price" class="active">{{ __('Harga') }}</label>
			<input type="text" id="price" name="price" value="{{ number_format($product->purchase_price, 0, ',', '.') }}" readonly>
		</div>

		<div class="input-field col s12" style="margin-top: 0.5rem;margin-bottom: 0rem;">
			<label for="amount" class="active">{{ __('Jumlah') }} <span class="required" style="color: #dd4b39;">*</span></label>
			<input type="number" id="amount{{ $product->id }}" name="amount" value="{{ $purchaseDetail ? $purchaseDetail->amount : '' }}">
			<input type="hidden" id="product-id{{ $product->id }}" name="product_id" value="{{ $product->id }}">
			<input type="hidden" id="purchase-transaction-id{{ $product->id }}" name="purchase_transaction_id" value="{{ $purchaseTransaction->id }}">
		</div>

		<button data-dismiss="modal" type="button"
			class="mb-12 btn waves-effect waves-light green darken-1 btn-small btn-block modal-close" id="modal-btn"
			onclick="addToPoCart()" width="100%">
			<b>Masukkan ke Keranjang</b>
		</button>
	</div>
</div>

<script>
	function addToPoCart() {
		
	var purchase_transaction_id = $('#purchase-transaction-id{{ $product->id }}').val();
	var product_id = $("#product-id{{ $product->id }}").val();
	var amount = $("#amount{{ $product->id }}").val();
	$.ajax({
		type: "POST",
		url: "{{ url('/preorder/add_to_cart_po') }}",
		data: {
			'purchase_transaction_id': purchase_transaction_id,
			'product_id': product_id,
			'amount': amount,
			'_token': $('input[name=_token]').val(),
		},
		success: function( data ) {
			$("#reload_cart").load(window.location.href + "/refresh" );
		}
	})

	}
</script>
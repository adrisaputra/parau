<div id="reload_cart">
	<table class="highlight collection email-collection">
		<tbody>
			@php $total = 0 ;@endphp
			@foreach ($sellingDetail as $v)
			<tr role="row" class="odd">
				<input type="hidden" class="form-control" value="{{ $v->id }}" id="id{{ $v->id }}">
				<td style="width: 90%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger"><b>{{ $v->product->product_name }}<b><br>
							<p style="font-size:10px;">{{ number_format($v->product->selling_price, 0, ',', '.') }}</p>
				</td>
				<td style="width: 5%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger">x{{ $v->amount }}</td>
				<td style="width: 90%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger">{{ number_format($v->price, 0, ',', '.') }}</td>
				<td style="width: 1%">
					<a class="btn btn-small waves-effect waves-light red darken-1" onclick="DeleteCart{{ $v->id }}()"><small class="nav-icon fas fa-trash"></small> Hapus</a>
				</td>
			</tr>
			<script>
				function DeleteCart{{ $v->id }}() {
																
															id = document.getElementById("id{{ $v->id }}").value;
															url = "{{ url('/cashier/delete_item') }}"
															$.ajax({
																type: "POST",
																url: "{{ url('/cashier/delete_item') }}",
																data: {
																	'id': id,
																	'_token': $('input[name=_token]').val(),
																},                            
																success: function( data ) {
 																	document.getElementById('barcode').focus();
																	// $("#reload_cart").load(window.location.href + "/refresh" );
																	
																	$("#reload_cart").load("{{ url('/cashier/create_search/refresh/') }}/"+{{ $v->selling_transaction_id }} );
																}
															});

															

														}
			</script>
			@php $total = $total + $v->price; @endphp
			@endforeach

			<tr role="row" class="odd">
				<input type="hidden" id="total_price" value="{{ $total }}" readonly>
				<th colspan=2>
					<p style="font-size:20px;">Total</p>
				</th>
				<th colspan=2>
					<p style="font-size:20px;color:green">{{ number_format($total, 0, ',', '.') }}</p>
				</th>
			</tr>
		</tbody>
	</table>
</div>

<script>
	// push harga ke modal
	document.getElementById('show-bayar-harga').innerHTML = ("{{ number_format($total, 0, ',', '.') }}");
	document.getElementById('bayar-harga').value = ("{{ $total }}");
</script>

<script>
	function diskon(){
		val = document.getElementById("discount").value.replace(/\./g, '');
		if(isNaN(parseFloat(val))){
			document.getElementById('bayar-harga').value = {{ $total }};
			val = parseInt(val);
			document.getElementById('show-bayar-harga').innerHTML = convertToRupiah({{ $total }});
		}else {
			document.getElementById('bayar-harga').value = {{ $total }} - val;
			val = parseInt(val);
			document.getElementById('show-bayar-harga').innerHTML = convertToRupiah({{ $total }} - val);
		}
		
		vals = document.getElementById("pay_cost").value.replace(/\./g,'');
		vals = parseInt(vals - $('#bayar-harga').val());
		vals = convertToRupiah(vals);
		document.getElementById('bayar-kembalian').value = vals;
	}
</script>
<script>
	function kembalian(){
		// val = parseInt($('#bayar-harga').val() - val);
		// if(val < 0) val = Math.abs(val)
		// else if(val > 0) val = -Math.abs(val)
		// $('#bayar-kembalian').val(val);
		val = document.getElementById("pay_cost").value.replace(/\./g, '');
		// discount = document.getElementById("discount").value.replace('.', '');
		val = parseInt(val - $('#bayar-harga').val());
		val = convertToRupiah(val);
		document.getElementById('bayar-kembalian').value = val;
	}
	// function call_modal()(){
	// 	var selling_transaction_id = $('#selling-transaction-id').val('TRX');
	// }
</script>
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
											<p style="text-align:center;font-size:20px;font-weight:bold;padding-bottom:30px">Tambah {{ __($title) }}</p>

											<div class="input-field col s6">
												<label style="font-size: 12px; margin-top: -27px;">{{ __('Nomor Keranjang:') }}</label>
												<input type="hidden" value="{{ $sellingTransaction->transaction_number }}" readonly>
												<select id="find_id" onChange="tampil()">
													@foreach($sellingTransaction2 as $v)
														<option value="{{ $v->id }}" @if(Request::segment(3)== $v->id) selected @endif>{{ $v->transaction_number}} ({{ $v->status}})</option>
													@endforeach
												<select>
												{{-- <input type="hidden" id="selling-transaction-id" value="{{ $sellingTransaction->id }}" readonly> --}}
											</div>

											<div class="input-field col s6">
												<label for="dtl-user">{{ __('User:') }}</label>
												<input type="text" id="dtl-user" value="{{ Auth::user()->name }}" readonly>
												<input type="hidden" id="dtl-user" value="{{ Auth::user()->id }}">
											</div>

											<!-- Daftar Produk -->
											<div class="app-email">
												<div class="col s12 m8 l8 animate fadeRight">
													<!-- Total Transaction -->
													<div class="card card card-default scrollspy border-radius-6 fixed-width">
														<div class="card-content">
															<h4 class="card-title mb-0">Daftar Produk</h4>
															<div class="card-title content-right">
																
																<div class="col s6">
																	<div class="app-file-header-search">
																		<div class="input-field m-0">
																			<input type="text" id="barcode" onChange="addToCartBarcode()" placeholder="Scan Barcode" name="code" style="border-bottom: 1px solid #e2dfdf;" autofocus>
																		</div>
																	</div>
																</div>
																<div class="col s6">
																	<div class="app-file-header-search">
																		<div class="input-field m-0">
																			<input type="text" id="product_search" onkeyup="searchBox()" placeholder="Pencarian" name="search" style="border-bottom: 1px solid #e2dfdf;">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row vertical-modern-dashboard" id="product-list">
																@foreach ($product as $v)
																<a onclick="productModal({{ $v->id }})" href="#modal" class="modal-trigger">
																	<div class="col s12 m8 l6 xl4 animate fadeRight">
																		<div class="card">
																			<div class="card-content">
																				<h4 class="card-title mb-0" style="line-height: 22px;">{!! Str::limit(strip_tags($v->product_name), 20, '...') !!}</h4>
																				{{-- @php $jumlah_karakter = strlen($v->product_name); @endphp
																				@if($jumlah_karakter<=15) <br> @endif --}}
																					@if($v->image == '' or $v->image == null)
																					<img src="{{ asset('upload/product/dummy-img.png') }}" class="img-circle" alt="User Image" width="100%" height="150px">
																					@else
																					<img src="{{ asset('storage/upload/product_image/thumbnail/'.$v->image) }}" class="img-circle" alt="User Image" width="100%" height="150px">
																					@endif
																					<p style="color:green;font-weight:bold;font-size:18px;text-align:center">Rp.{{ number_format($v->selling_price, 0, ',', '.') }}
																			</div>
																			<div class="card-footer m-0 p-0 progress-group text-left">
																				<span class="progress progress-md stock-progress rounded-bottom" style="height: 20px;">
																					@php
																					$percent = round(($v->inventory->in_stock / $v->inventory->full_stock) * 100);
																					$color = 'grey';
																					if ($percent < 33) { $color='red' ; } elseif ($percent < 66) { $color='orange' ; } else { $color='green' ; } @endphp <div class="my-progress">
																						<div class="my-progress-bar {{ $color }}" role="progressbar" style="width: {{ $percent }}%; color: white;font-size:8px" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
																						<small style="position: absolute; color: black;font-size:16px">
																							Stok:
																							<b id="modal-in-stock">{{ $v->inventory->in_stock }}</b>/
																							<span id="modal-full-stock">{{ $v->inventory->full_stock }}</span>
																						</small>
																			</div>
																			</span>
																		</div>
																	</div>
															</div>
															</a>
															@endforeach
														</div>
													</div>
												</div>
											</div>

											{{-- MODAL BAYAR --}}
											<!-- Modal Structure -->
											<div id="modal1" class="modal modal-fixed-footer">
												<div class="modal-content">
													<h4>Bayar</h4>
													<div id="view-input-fields">
														<div class="row">
															<div class="input-field col s6">
																<label for="selling-transaction-id">{{ __('Nomor Keranjang:') }}</label>
																<input type="text" value="{{ $sellingTransaction->transaction_number }}" readonly>
																<input type="hidden" id="selling-transaction-id" value="{{ $sellingTransaction->id }}" readonly>
															</div>

															<div class="input-field col s6">
																<label for="dtl-user">{{ __('Tanggal:') }}</label>
																<input type="text" id="transaction_date" value="{{ date('Y-m-d H:i:s') }}" readonly>
															</div>

															<div class="input-field col s6">
																<label for="dtl-user">{{ __('Tanggal:') }}</label>
																<input type="text" id="bayar-member" value="UMUM" readonly>
															</div>

															<div class="input-field col s6">
																<label for="dtl-user">{{ __('User:') }}</label>
																<input type="text" id="dtl-user" value="{{ Auth::user()->name }}" readonly>
																<input type="hidden" id="dtl-user" value="{{ Auth::user()->id }}">
															</div>

															<div class="input-field col s12">
																<p style="font-size:15px;font-weight:bold;">Total Belanja:</p>
																<p style="font-size:35px;font-weight:bold;">Rp. <span id="show-bayar-harga"> 0,00</span></p>
																<input class="green-text darken-2 mt-2" type="hidden" id="bayar-harga" value="" readonly>
															</div>

															<div class="input-field col s4">
																<label for="discount">{{ __('Diskon (Rp.):') }}</label>
																<input type="text" id="discount" value=""  onkeyup="formatRupiah(this, '.')" oninput="diskon()">
															</div>

															<div class="input-field col s4">
																<label for="pay_cost">{{ __('Uang Bayar (Rp.):') }}</label>
																<input type="text" id="pay_cost" value=""  onkeyup="formatRupiah(this, '.')" oninput="kembalian()">
															</div>

															<div class="input-field col s4">
																<label for="dtl-user">{{ __('Uang Kembali (Rp.):') }}</label>
																<input type="text" id="bayar-kembalian" value="0,00" readonly>
															</div>

														</div>
													</div>
												</div>
												<div class="modal-footer">
													{{-- <button onclick="confirm()" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">save</i></button> --}}
													<button onclick="pay()" class="btn green darken-2 btn-flat" style="width:100%; color:white;">
														<b>Bayar</b>
													</button>
												</div>
											</div>
											{{-- END MODAL BAYAR --}}

											<!-- Keranjang Kasir -->
											<div class="col s12 m4 l4">
												<!-- Current Balance -->
												<div class="card animate fadeLeft">
													<div class="card-content">
														<h4 class="card-title mb-0">Keranjang</h4>
														<div id="reload_cart" style="overflow-x:auto;">
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
													</div>
												</div>
											</div>
										</div>
										<div id="modal" class="modal" style="width: 30%;">
											<div class="modal-content">
												<div div id="product-modal"></div>
											</div>
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
			<a class="btn-floating btn-large modal-trigger green darken-2" href="#modal1"><i class="material-icons">add_shopping_cart</i>Modal</a>
			<a class="btn-floating btn-large blue darken-2" href="{{ url('/'.Request::segment(1).'/hold/'.$sellingTransaction->id) }}" onclick="return confirm('Anda Yakin ?');"><p style="margin-top:3px;font-weight:bold">Hold</p></a>
			<a class="btn-floating btn-large red darken-2" href="{{ url('/'.Request::segment(1).'/hapus/'.$sellingTransaction->id) }}" onclick="return confirm('Anda Yakin ?');"><i class="material-icons">close</i></a>
			<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">arrow_back</i></a>
		</div>
	</div>
	<div class="content-overlay"></div>
</div>
</div>
</div>




<!-- END: Page Main-->
<script>
function tampil(){
    search = document.getElementById("find_id").value;
    url = "{{ url('/cashier/create_search/') }}"
    $.ajax({
        success:function(){
              location.href=""+url+"/"+search+"";    
            }
    });
    return false;
}
</script>
<script>
	function convertToRupiah(angka){
        var rupiah = '';    
        var angkarev = angka.toString().split('').reverse().join('');
        
        for(var i = 0; i < angkarev.length; i++) 
        if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        
        return rupiah.split('',rupiah.length-1).reverse().join('');
    }
</script>
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
		
		if(document.getElementById("pay_cost") && document.getElementById("pay_cost").value){
			document.getElementById('bayar-kembalian').value = vals;
		}

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

<script>
	function searchBox(){
    search = document.getElementById("product_search").value;
    url = "{{ url('/cashier/search_box') }}"
    $.ajax({
        url:""+url+"?search="+search+"",
        success: function(response){
        $("#product-list").html(response);
        }
    });
    return false;
}
</script>
<script>
	function productModal(id){
    url = "{{ url('/cashier/get_modal_data_search') }}"
    $.ajax({
        url:""+url+"/"+{{ $sellingTransaction->id }}+"?id="+id+"",
        success: function(response){
        $("#product-modal").html(response);
        }
    });
    return false;
}
</script>
<script>
	@foreach ($sellingDetail as $v)
		function DeleteCart{{ $v->id }}() {
				
			id = document.getElementById("id{{ $v->id }}").value;
			$.ajax({
				type: "POST",
				url: "{{ url('/cashier/delete_item') }}",
				data: {
					'id': id,
					'_token': $('input[name=_token]').val(),
				},                            
				success: function( data ) {
 					document.getElementById('barcode').focus();
					$("#reload_cart").load("{{ url('/cashier/create_search/refresh/') }}/"+{{ $sellingTransaction->id }} );
				}
			});
		}
	@endforeach
</script>

<script>
	@foreach ($product as $v)
		function addToCart{{ $v->id }}() {
			
		var selling_transaction_id = $('#selling-transaction-id').val();
		var product_id = $("#product-id{{ $v->id }}").val();
		var amount = $("#amount{{ $v->id }}").val();
		$.ajax({
			type: "POST",
			url: "{{ url('/cashier/add_to_cart') }}",
			data: {
				'selling_transaction_id': selling_transaction_id,
				'product_id': product_id,
				'amount': amount,
				'_token': $('input[name=_token]').val(),
			},
			success: function( response ) {
				if(response == 'failed'){
					swal('Gagal', 'Melebihi stok yang tersedia', 'error')
				} else {
 					document.getElementById('barcode').focus();
					// $("#reload_cart").load(window.location.href + "/refresh" );
					$("#reload_cart").load("{{ url('/cashier/create_search/refresh/') }}/"+{{ $sellingTransaction->id }} );
				}
			}
		})

		}
	@endforeach
</script>
<script>
		function addToCartBarcode() {
			
		var selling_transaction_id = $('#selling-transaction-id').val();
		var barcode = $('#barcode').val();

		$.ajax({
			type: "POST",
			url: "{{ url('/cashier/add_to_cart_barcode') }}",
			data: {
				'selling_transaction_id': selling_transaction_id,
				'code': barcode,
				'_token': $('input[name=_token]').val(),
			},
			success: function( response ) {
				document.getElementById("barcode").value="";
				if(response == 'failed'){
					swal('Gagal', 'Melebihi stok yang tersedia', 'error')
				} else {
 					document.getElementById('barcode').focus();
					// $("#reload_cart").load(window.location.href + "/refresh" );
					$("#reload_cart").load("{{ url('/cashier/create_search/refresh/') }}/"+{{ $sellingTransaction->id }} );
				}
			}
		})

		}
</script>
<script>
	function pay() {
			
		var selling_transaction_id = $('#selling-transaction-id').val();
		var member_id = $('#member_id').val();
		var total_price = $('#total_price').val();
		var transaction_date = $('#transaction_date').val();
		var pay_cost = $('#pay_cost').val();
		var discount = $('#discount').val();
		// if(member_id == ''){
		// 	swal('Gagal', 'Pilih Member Terlebih Dahulu', 'error')
		// }
		if(total_price == 0){
			swal('Gagal', 'Keranjang Kosong', 'error')
		}else{
			$.ajax({
				type: "POST",
				url: "{{ url('/cashier/order') }}",
				data: {
					'selling_transaction_id': selling_transaction_id,
					'member_id': member_id, 
					'pay_cost': pay_cost,
					'discount': discount,
					'total_price': total_price,
					'transaction_date': transaction_date,
					'_token': $('input[name=_token]').val(),
				},                            
				success: function( data ) {
					window.location.href = "{{ url('/cashier/print') }}";
				}
			});
		}
	}
</script>
@endsection
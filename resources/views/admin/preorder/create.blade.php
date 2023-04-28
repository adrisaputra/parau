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
									<label for="purchase-transaction-id">{{ __('Nomor Pre Order:') }}</label>
									<input type="text" value="{{ $purchaseTransaction->transaction_number }}" readonly>
									<input type="hidden" id="purchase-transaction-id" value="{{ $purchaseTransaction->id }}" readonly>
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
													<div class="col s12">
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
													<div class="col s12 m8 l4 animate fadeRight">
														<div class="card">
															<div class="card-content">
																<h4 class="card-title mb-0" style="line-height: 22px;">{{ $v->product_name }}</h4>
																@php $jumlah_karakter  = strlen($v->product_name); @endphp
																@if($jumlah_karakter<=15) <br> @endif
																@if($v->image)
																	<img src="{{ asset('storage/upload/product_image/thumbnail/'.$v->image) }}" class="img-circle" alt="User Image"  width="100%" height="150px">
																@else
																	<img src="{{ asset('upload/product/dummy-img.png') }}" class="img-circle" alt="User Image" width="100%" height="150px">
																@endif
																<p style="color:green;font-weight:bold;font-size:18px;text-align:center">Rp.{{ number_format($v->purchase_price, 0, ',', '.') }}
																
															</div>
															<div class="card-footer m-0 p-0 progress-group text-left">
																<span class="progress progress-md stock-progress rounded-bottom" style="height: 20px;">
																	@php
																		$percent = round(($v->inventory->in_stock / $v->inventory->full_stock) * 100);
																		$color = 'grey';
																		if ($percent < 33) {
																			$color = 'red';
																		} elseif ($percent < 66) {
																			$color = 'orange';
																		} else {
																			$color = 'green';
																		}
																	@endphp
																	<div class="my-progress">
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
										
									<!-- Keranjang PO -->
									<div class="col s12 m4 l4">
										<!-- Current Balance -->
										<div class="card animate fadeLeft">
											<div class="card-content">
												<h4 class="card-title mb-0">Keranjang PO</h4>
												<div id="reload_cart" style="overflow-x:auto;">
												<table class="highlight collection email-collection">
													<tbody>
														@php $total = 0 ;@endphp
														@foreach ($purchaseDetail as $v)
														<tr role="row" class="odd">
															<input type="hidden" class="form-control" value="{{ $v->id }}" id="id{{ $v->id }}">
															<td style="width: 90%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger"><b>{{ $v->product->product_name }}<b><br><p style="font-size:10px;">{{ number_format($v->product->purchase_price, 0, ',', '.') }}</p></td>
															<td style="width: 5%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger">x{{ $v->amount }}</td>
															<td style="width: 90%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger">{{ number_format($v->price, 0, ',', '.') }}</td>
															<td style="width: 1%">
															<a class="btn btn-small waves-effect waves-light red darken-1" onclick="DeletePoCart{{ $v->id }}()" ><small class="nav-icon fas fa-trash"></small> Hapus</a>
															</td>
														</tr>
														@php $total = $total + $v->price; @endphp
														@endforeach
														
														<tr role="row" class="odd">
															<input type="hidden" id="total_price" value="{{ $total }}" readonly>
															<th colspan=2><p style="font-size:20px;">Total</p></th>
															<th colspan=2><p style="font-size:20px;color:green">{{ number_format($total, 0, ',', '.') }}</p></th>
														</tr>
													</tbody>
												</table>
												</div>
											</div>
										</div>
										<div class="input-field col s12">
											<select class="select2 browser-default" name="status" id="supplier_id" required>
												<option value="">- Pilih Supplier -</option>
												@foreach($supplier as $v)
													<option value="{{ $v->id }}" >{{ $v->supplier_name }}</option>
												@endforeach
											</select>
											@if ($errors->has('status'))<small><div class="error">{{ $errors->first('status') }}</div></small>@endif
										</div>
									</div>
								</div>

								<div id="modal" class="modal" style="width: 30%;">
									<div class="modal-content">
										<div	id="product-modal"></div>
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
				<button  onclick="confirmPO()" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">save</i></button>
				<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
<script>
function searchBox(){
    search = document.getElementById("product_search").value;
    url = "{{ url('/preorder/search_box_po') }}"
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
    url = "{{ url('/preorder/get_modal_data_po') }}"
    $.ajax({
        url:""+url+"?id="+id+"",
        success: function(response){
        $("#product-modal").html(response);
        }
    });
    return false;
}
</script>
<script>
	@foreach ($purchaseDetail as $v)
		function DeletePoCart{{ $v->id }}() {
				
			id = document.getElementById("id{{ $v->id }}").value;
			$.ajax({
				type: "POST",
				url: "{{ url('/preorder/delete_item_po') }}",
				data: {
					'id': id,
					'_token': $('input[name=_token]').val(),
				},                            
				success: function( data ) {
					$("#reload_cart").load(window.location.href + "/refresh" );
				}
			});
		}
	@endforeach
</script>
<script>
	@foreach ($product as $v)
		function addToPoCart{{ $v->id }}() {
			
		var purchase_transaction_id = $('#purchase-transaction-id').val();
		var product_id = $("#product-id{{ $v->id }}").val();
		var amount = $("#amount{{ $v->id }}").val();
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
	@endforeach
</script>
<script>
	function confirmPO() {
			
		var purchase_transaction_id = $('#purchase-transaction-id').val();
		var supplier_id = $('#supplier_id').val();
		var total_price = $('#total_price').val();

		if(supplier_id == ''){
			swal('Gagal', 'Pilih Supplier Terlebih Dahulu', 'error')
		} else {
			$.ajax({
				type: "POST",
				url: "{{ url('/preorder/order') }}",
				data: {
					'purchase_transaction_id': purchase_transaction_id,
					'supplier_id': supplier_id,
					'total_price': total_price,
					'_token': $('input[name=_token]').val(),
				},                            
				success: function( data ) {
					swal("Berhasil!", "Data PO Disimpan!", "success").then(function() {
						window.location.href = "{{ url('/preorder') }}";
					});

				}
			});
		}
		
	}
</script>
@endsection
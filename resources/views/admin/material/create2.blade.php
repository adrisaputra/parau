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
									<p style="text-align:center;font-size:20px;font-weight:bold">Tambah {{ __($title) }}</p>

										<div class="input-field col s4">
											<label for="purchase-transaction-id">{{ __('Nama Client:') }}</label>
											<input type="text" value="{{ $project->client_name }}" readonly>
										</div>

										<div class="input-field col s4">
											<label for="dtl-user">{{ __('No HP:') }}</label>
											<input type="text" id="dtl-user" value="{{ $project->phone }} " readonly>
										</div>
										
										<div class="input-field col s4">
											<label for="dtl-user">{{ __('Nama Project:') }}</label>
											<input type="text" id="dtl-user" value="{{ $project->project_name }} " readonly>
										</div>
										
										<div class="input-field col s12">
											<select class="browser-default" name="purchase_place" onchange=" if (this.selectedIndex==1){ 
												document.getElementById('IN').style.display = 'inline'; 
												document.getElementById('OUT').style.display = 'none'; 
												document.getElementById('purchase_place2').value = 'IN'; 
											} else if (this.selectedIndex==2){
												document.getElementById('IN').style.display = 'none'; 
												document.getElementById('OUT').style.display = 'inline'; 
												document.getElementById('purchase_place2').value = 'OUT'; 
											};">
												<option value="">- Pilih Tempat Pembelian -</option>
												<option value="IN" @if(old('purchase_place2')=="IN") selected @endif>Dari Toko</option>
												<option value="OUT" @if(old('purchase_place2')=="OUT") selected @endif>Dari Luar Toko</option>
											</select>
											@if ($errors->has('purchase_place'))<small><div class="error">{{ $errors->first('purchase_place') }}</div></small>@endif
										</div>

										@if(old('purchase_place2') =="IN")
											<span id="IN" style="display:inline;">
										@else
											<span id="IN" style="display:none;">
										@endif

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
																			<input type="text" id="barcode" onChange="addToCartBarcode({{ $project->id }})" placeholder="Scan Barcode" name="code" style="border-bottom: 1px solid #e2dfdf;" autofocus>
																		</div>
																	</div>
																</div>
																<div class="col s6">
																	<div class="app-file-header-search">
																		<div class="input-field m-0">
																			<input type="text" id="product_search" onkeyup="searchBox({{ $project->id }})" placeholder="Pencarian" name="search" style="border-bottom: 1px solid #e2dfdf;">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row vertical-modern-dashboard" id="product-list">
																@foreach ($product as $v)
																<a onclick="productModal({{ $v->id }},{{ $project->id }})" href="#modal" class="modal-trigger">
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
											
											<form action="{{ url('/'.Request::segment(1).'/'.$project->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
											{{ csrf_field() }}

											<input type="hidden" id="purchase_place2" name="purchase_place2" value="{{ old('purchase_place2') }}">

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
																	@foreach ($material as $v)
																	<tr role="row" class="odd">
																		<input type="hidden" class="form-control" value="{{ $v->id }}" id="id{{ $v->id }}">
																		<td style="width: 90%" onclick="productModal({{ $v->product->id }},{{ $project->id }})" href="#modal" class="modal-trigger"><b>{{ $v->product->product_name }}<b><br>
																					<p style="font-size:10px;">{{ number_format($v->product->selling_price, 0, ',', '.') }}</p>
																		</td>
																		<td style="width: 5%" onclick="productModal({{ $v->product->id }},{{ $project->id }})" href="#modal" class="modal-trigger">x{{ $v->amount }}</td>
																		<td style="width: 90%" onclick="productModal({{ $v->product->id }},{{ $project->id }})" href="#modal" class="modal-trigger">{{ number_format($v->price * $v->amount, 0, ',', '.') }}</td>
																		<td style="width: 1%">
																			<a class="btn btn-small waves-effect waves-light red darken-1" onclick="DeleteCart{{ $v->id }}()"><small class="nav-icon fas fa-trash"></small> Hapus</a>
																		</td>
																	</tr>
																	@php $total = $total + ($v->price * $v->amount) ; @endphp

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
										</span>

										@if(old('purchase_place2')=="OUT")
											<span id="OUT" style="display:inline;">
										@else
											<span id="OUT" style="display:none;">
										@endif
											<div class="input-field col s6">
												<label for="outlet_name">{{ __('Nama Toko') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="outlet_name" name="outlet_name" value="{{ old('outlet_name') }}" style="@if ($errors->has('outlet_name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('outlet_name'))<small><div class="error">{{ $errors->first('outlet_name') }}</div></small>@endif
											</div>

											<div class="input-field col s6">
												<label for="product_name2">{{ __('Nama Produk') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="product_name2" name="product_name2" value="{{ old('product_name2') }}" style="@if ($errors->has('product_name2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('product_name2'))<small><div class="error">{{ $errors->first('product_name2') }}</div></small>@endif
											</div>

											<div class="input-field col s4">
												<label for="price2">{{ __('Harga') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="price2" name="price2" value="{{ old('price2') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('price2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('price2'))<small><div class="error">{{ $errors->first('price2') }}</div></small>@endif
											</div>

											<div class="input-field col s4">
												<label for="unit2">{{ __('Satuan') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="unit2" name="unit2" value="{{ old('unit2') }}"  style="@if ($errors->has('unit2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('unit2'))<small><div class="error">{{ $errors->first('unit2') }}</div></small>@endif
											</div>

											<div class="input-field col s4">
												<label for="amount2">{{ __('Jumlah') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="amount2" name="amount2" value="@if(old('amount2')){{ old('amount2') }} @else 0 @endif" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('amount2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('amount2'))<small><div class="error">{{ $errors->first('amount2') }}</div></small>@endif
											</div>

											<div class="input-field col s12">
												<label for="date2">{{ __('Tanggal') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="date2" onChange="getNumberOfDays()" class="datepicker2" name="date2" value="@if(old('date2')) {{old('date2')}} @else {{date('Y-m-d')}} @endif" style="@if ($errors->has('date'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('date2'))<small><div class="error">{{ $errors->first('date2') }}</div></small>@endif
											</div>

										</span>

							</div>
						</div>
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>
			<div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
				<button type="submit" class="btn-floating btn-large waves-effect waves-light green darken-2" onclick="return confirm('Anda Yakin ?');"><i class="material-icons">save</i></button>
				<a href="{{ url('/'.Request::segment(1).'/'.$project->id) }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
		</form>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
    
<script>
	 function convertToRupiah(angka){
        var rupiah = '';    
        var angkarev = angka.toString().split('').reverse().join('');
        
        for(var i = 0; i < angkarev.length; i++) 
        if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        
        return rupiah.split('',rupiah.length-1).reverse().join('');
    }

function getProduct(){
	product_id = document.getElementById("product_id").value;
	url = "{{ url('/product/get_data') }}"
	$.ajax({
		url:""+url+"/"+product_id+"",
		success: function(response){
			document.getElementById("product_name").value=response.product_name;
			document.getElementById("price").value=convertToRupiah(response.selling_price);
			document.getElementById("unit").value=response.unit;
		}
	});
	return false;
}
document.addEventListener('DOMContentLoaded', function() {
	var options = {
		format: "dd-mm-yyyy",
		autoClose: true,
		setDefaultDate: true
	};
	var elems = document.querySelector('.datepicker');
	var elems2 = document.querySelector('.datepicker2');
	var instance = M.Datepicker.init(elems, options);
	var instance = M.Datepicker.init(elems2, options);
});

function searchBox(project_id){
    search = document.getElementById("product_search").value;
    url = "{{ url('/material/search_box') }}"
    $.ajax({
        url:""+url+"/"+project_id+"?search="+search,
        success: function(response){
        $("#product-list").html(response);
        }
    });
    return false;
}
</script>
<script>
	function productModal(id, project_id){
	url = "{{ url('/material/get_modal_data') }}"
	$.ajax({
		url:""+url+"/"+project_id+"?id="+id,
		success: function(response){
		$("#product-modal").html(response);
		}
	});
	return false;
}
</script>
<script>
	function addToCartBarcode(project_id) {
		
		var barcode = $('#barcode').val();

		$.ajax({
			type: "POST",
			url: "{{ url('/material/add_to_cart_barcode/'.$project->id) }}",
			data: {
				'project_id': project_id,
				'code': barcode,
				'_token': $('input[name=_token]').val(),
			},
			success: function( response ) {
				document.getElementById("barcode").value="";
				if(response == 'failed'){
					swal('Gagal', 'Melebihi stok yang tersedia', 'error')
				} else {
					document.getElementById('barcode').focus();
					$("#reload_cart").load("{{ url('material/create/refresh/'.$project->id) }}");
				}
			}
		})

	}
</script>
<script>
	@foreach ($material as $v)
		function DeleteCart{{ $v->id }}() {
				
			id = document.getElementById("id{{ $v->id }}").value;
			$.ajax({
				type: "POST",
				url: "{{ url('/material/delete_item/'.$project->id) }}",
				data: {
					'id': id,
					'_token': $('input[name=_token]').val(),
				},                            
				success: function( data ) {
 					document.getElementById('barcode').focus();
					$("#reload_cart").load("{{ url('material/create/refresh/'.$project->id) }}");
				}
			});
		}
	@endforeach
</script>
@endsection
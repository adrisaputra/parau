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
	   
		<form action="{{ url('/'.Request::segment(1).'/edit/'.$project->id.'/'.$material->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
								<form class="row">
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
											<label for="purchase_place" class="active">{{ __('Tempat Pembelian') }}</label>
											@if($material->purchase_place=="IN")
												<input type="hidden" name="purchase_place" value="IN">
												<input type="text" id="purchase_place" value="Dari Toko" readonly>
											@else
												<input type="hidden" name="purchase_place" value="OUT">
												<input type="text" id="purchase_place" value="Dari Luar Toko" readonly>
											@endif
											@if ($errors->has('purchase_place'))<small><div class="error">{{ $errors->first('purchase_place') }}</div></small>@endif
										</div>

										@if($material->purchase_place =="IN")
											<span id="IN" style="display:inline;">
										@else
											<span id="IN" style="display:none;">
										@endif
											<div class="input-field col s12">
												<select class="select2 browser-default" name="product_id" id="product_id" onChange="getProduct()">
													<option value="">- Pilih Produk -</option>
													@foreach($product as $v)
														<option value="{{ $v->id }}" @if($material->product_id=="$v->id") selected @endif>{{ $v->product_name }}</option>
													@endforeach
												</select>
												@if ($errors->has('product_id'))<small><div class="error">{{ $errors->first('product_id') }}</div></small>@endif
											</div>

											<input type="hidden" id="product_name" name="product_name" value=" " readonly>

											<div class="input-field col s4">
												<label for="price" class="active">{{ __('Harga') }}</label>
												<input type="text" id="price" name="price" value="{{ $material->price }}" readonly>
											</div>

											<div class="input-field col s4">
												<label for="unit" class="active">{{ __('Satuan') }}</label>
												<input type="text" id="unit" name="unit" value="{{ $material->unit }}" readonly>
											</div>

											<div class="input-field col s4">
												<label for="amount">{{ __('Jumlah') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="number" id="amount" name="amount" value="{{ number_format($material->amount, 0, ',', '.') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('amount'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('amount'))<small><div class="error">{{ $errors->first('amount') }}</div></small>@endif
											</div>

											<div class="input-field col s12">
												<label for="date">{{ __('Tanggal') }} <span class="required" style="color: #dd4b39;">*</span></label>
												@php
												$d = substr($material->date,8,2);
												$m = substr($material->date,5,2);
												$y = substr($material->date,0,4);
												@endphp
												<input type="text" id="date" class="datepicker" name="date" value="{{ $d }}-{{ $m }}-{{ $y }}" style="@if ($errors->has('date'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('date'))<small><div class="error">{{ $errors->first('date') }}</div></small>@endif
											</div>

										</span>

										@if($material->purchase_place=="OUT")
											<span id="OUT" style="display:inline;">
										@else
											<span id="OUT" style="display:none;">
										@endif
													
											<div class="input-field col s6">
												<label for="outlet_name">{{ __('Nama Toko') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="outlet_name" name="outlet_name" value="{{ $material->outlet_name }}" style="@if ($errors->has('outlet_name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('outlet_name'))<small><div class="error">{{ $errors->first('outlet_name') }}</div></small>@endif
											</div>

											<div class="input-field col s6">
												<label for="product_name2">{{ __('Nama Produk') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="product_name2" name="product_name2" value="{{ $material->product_name }}" style="@if ($errors->has('product_name2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('product_name2'))<small><div class="error">{{ $errors->first('product_name2') }}</div></small>@endif
											</div>

											<div class="input-field col s4">
												<label for="price2">{{ __('Harga') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="price2" name="price2" value="{{ number_format($material->price, 0, ',', '.') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('price2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('price2'))<small><div class="error">{{ $errors->first('price2') }}</div></small>@endif
											</div>

											<div class="input-field col s4">
												<label for="unit2">{{ __('Satuan') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="unit2" name="unit2" value="{{ $material->unit }}"  style="@if ($errors->has('unit2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('unit2'))<small><div class="error">{{ $errors->first('unit2') }}</div></small>@endif
											</div>

											<div class="input-field col s4">
												<label for="amount2">{{ __('Jumlah') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="number" id="amount2" name="amount2" value="{{ number_format($material->amount, 0, ',', '.') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('amount2'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('amount2'))<small><div class="error">{{ $errors->first('amount2') }}</div></small>@endif
											</div>

											<div class="input-field col s12">
												<label for="date2">{{ __('Tanggal') }} <span class="required" style="color: #dd4b39;">*</span></label>
												<input type="text" id="date2" onChange="getNumberOfDays()" class="datepicker2" name="date2" value="{{ $d }}-{{ $m }}-{{ $y }}" style="@if ($errors->has('date'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
												@if ($errors->has('date2'))<small><div class="error">{{ $errors->first('date2') }}</div></small>@endif
											</div>

										</span>

								</form>
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
</script>
@endsection
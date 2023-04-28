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
	   
		<form action="{{ url('/'.Request::segment(1)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
		{{ csrf_field() }}

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
									<div class="col s12">

										<div class="input-field col s12">
											<label for="code">{{ __('Kode Produk') }}</label>
											<input type="text" id="code" name="code" value="{{ old('code') }}" style="@if ($errors->has('code'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('code'))<small><div class="error">{{ $errors->first('code') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<label for="product_name">{{ __('Nama Produk') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}" style="@if ($errors->has('product_name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('product_name'))<small><div class="error">{{ $errors->first('product_name') }}</div></small>@endif
										</div>
										
										<div class="input-field col s12">
											<label for="description">{{ __('Deskripsi') }}</label>
											<input type="text" id="description" name="description" value="{{ old('description') }}" style="@if ($errors->has('description'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('description'))<small><div class="error">{{ $errors->first('description') }}</div></small>@endif
										</div>
										
										<div class="input-field col s12">
											<label for="unit">{{ __('Satuan') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="unit" name="unit" value="{{ old('unit') }}" style="@if ($errors->has('unit'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('unit'))<small><div class="error">{{ $errors->first('unit') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<p>{{ __('Kategori') }}</p>
											<select class="select2 browser-default" multiple="multiple" name="category_id[]">
												@foreach($category as $v)
													<option value="{{$v->id}}" @if(old('category_id')==$v->id) selected @endif>{{ $v->category_name }}</option>
												@endforeach
											</select>
											@if ($errors->has('status'))<small><div class="error">{{ $errors->first('status') }}</div></small>@endif
										</div>
										
										<div class="input-field col s6">
											<label for="purchase_price">{{ __('Harga Beli (Rp)') }}  <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('purchase_price'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('purchase_price'))<small><div class="error">{{ $errors->first('purchase_price') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<label for="selling_price">{{ __('Harga Jual (Rp)') }}  <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('selling_price'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('selling_price'))<small><div class="error">{{ $errors->first('selling_price') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<label for="min_stock">{{ __('Min Stok') }}  <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="min_stock" name="min_stock" value="{{ old('min_stock') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('min_stock'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('min_stock'))<small><div class="error">{{ $errors->first('min_stock') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<label for="full_stock">{{ __('Full. Stok') }}  <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="full_stock" name="full_stock" value="{{ old('full_stock') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('full_stock'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('full_stock'))<small><div class="error">{{ $errors->first('full_stock') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<div class="file-field input-field">
												<div class="btn waves-light cyan darken-0" style="line-height: 2rem;float: left;height: 2rem;">
													<span>Upload Gambar</span>
													<input type="file" name="image" >
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" type="text" style="height: 2rem;">
												</div>
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
											</div>
										</div>
										
									</div>
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
				<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
		</form>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
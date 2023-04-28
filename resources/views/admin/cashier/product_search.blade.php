<div class="row vertical-modern-dashboard" id="product-list">
	@foreach ($product as $v)
	<a onclick="productModal({{ $v->id }})" href="#modal" class="modal-trigger">
		<div class="col s12 m8 l6 xl4 animate fadeRight">
			<div class="card">
				<div class="card-content">
					<h4 class="card-title mb-0" style="line-height: 22px;">{!! Str::limit(strip_tags($v->product_name), 20, ' ...') !!}</h4>
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
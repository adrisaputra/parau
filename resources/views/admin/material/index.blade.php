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
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
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
				<!-- Borderless Table -->
				<div class="row">
					<div class="col s12">
						<div id="borderless-table" class="card card-tabs">
						<div class="card-content">
							<div id="view-borderless-table " >
							<div class="row">

								@if ($message = Session::get('status'))
									<div class="col s12">
										<div class="card-alert card cyan">
											<div class="card-content white-text">
											<p style="font-size:24px"><i class="icon fa fa-check"></i> Berhasil !</p>
											<p>{{ $message }}</p>
											</div>
										</div>
									</div>
								@endif
								
								<div class="input-field col s4" >
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
								
								<div class="col s12 " style="overflow-x:auto;">
									<table class="highlight">
									<thead>
										<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
											<th>Tempat Pembelian</th>
											<th style="width: 60px">No</th>
											<th>Nama Produk</th>
											<th>Harga</th>
											<th>Jumlah</th>
											<th>Total</th>
											<th style="width: 20%">#aksi</th>
										</tr>
									</thead>
									<tbody>
										
										@php 
											$total = 0 ;
											$total2 = 0 ;
											if($selling_transaction==NULL){
												$discount = 0;
											} else {
												$discount = $selling_transaction->discount;
											}
										@endphp
										
										@if(count($in)>0)
											<tr>
												<td colspan=1>Dalam Toko</td>
												<td colspan=6>No. Transaksi : {{ $transaction_number->transaction_number }}</td>
											</tr>
											@foreach($in as $v)
											<tr>
												<td></td>
												<td>{{ $loop->index + 1 }}</td>
												<td>{{ $v->product_name2 }}</td>
												<td>{{ number_format($v->price, 0, ',', '.') }}</td>
												<td>{{ number_format($v->amount, 0, ',', '.') }}</td>
												<td>{{ number_format($v->price * $v->amount, 0, ',', '.') }}</td>
												<td>
													<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/edit/'.$project->id.'/'.$v->id ) }}">Edit</a>
													<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/hapus/'.$project->id.'/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>
											@php $total = $total + ($v->price * $v->amount); @endphp
											@endforeach
											<tr>
												<th><p></p></th>
												<th colspan=4><p>Sub Total</p></th>
												<th colspan=2><p>{{ number_format($total, 0, ',', '.') }}</p></th>
											</tr>
											<tr>
												<th><p></p></th>
												<th colspan=4><p>Diskon (Rp)</p></th>
												<th><p>{{ number_format($discount, 0, ',', '.') }}</p></th>
												<td><a class="mb-12 btn waves-effect waves-light blue darken-1 btn-small modal-trigger" href="#modal">Diskon (Rp)</a></td>
											</tr>
											<tr>
												<th><p></p></th>
												<th colspan=4><p>Total Bayar</p></th>
												<th colspan=2><p>{{ number_format($total-$discount, 0, ',', '.') }}</p></th>
											</tr>
										@endif
										@if(count($out)>0)
											<tr>
												<td colspan=7></td>
											</tr>
											@foreach($out as $v)
											<tr>
												<td>@if($loop->index==0) Luar Toko @endif</td>
												<td>{{ $loop->index + 1 }}</td>
												<td>{{ $v->product_name }}</td>
												<td>{{ number_format($v->price, 0, ',', '.') }}</td>
												<td>{{ number_format($v->amount, 0, ',', '.') }}</td>
												<td>{{ number_format($v->price * $v->amount, 0, ',', '.') }}</td>
												<td>
													<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/edit/'.$project->id.'/'.$v->id ) }}">Edit</a>
													<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/hapus/'.$project->id.'/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>
											@php $total2 = $total2 + ($v->price * $v->amount); @endphp
											@endforeach
											<tr>
												<th><p></p></th>
												<th colspan=4><p>Total Bayar</p></th>
												<th colspan=2><p>{{ number_format($total2, 0, ',', '.') }}</p></th>
											</tr>
										@endif
										<tr>
											<th colspan=5><p style="font-size:20px;">Total Bayar Keseluruhan</p></th>
											<th colspan=2><p style="font-size:20px;color:green">{{ number_format(($total+$total2)-$discount, 0, ',', '.') }}</p></th>
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
			@if($selling_transaction!=NULL)
				<form action="{{ url('/'.Request::segment(1).'/discount/'.$project->id.'/'.$selling_transaction->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
				
				<div id="modal" class="modal" style="max-height: 87%;">
					<div class="modal-content">
						<div class="row">
							<div class="input-field col s12">
								<label for="discount" class="active">{{ __('Diskon (Rp)') }}</label>
								<input type="text" id="discount" name="discount" value="{{ number_format($discount, 0, ',', '.') }}" onkeyup="formatRupiah(this, '.')">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="mb-12 btn waves-effect waves-light green darken-1">Simpan</button>
						<a href="#!" class="modal-action modal-close mb-12 btn waves-effect waves-light red darken-1">Tutup</a>
					</div>
				</div>
				</form>
			@endif
			<div style="bottom: 40px; right: 19px;" class="fixed-action-btn direction-top">
				<a href="{{ url('/'.Request::segment(1).'/create/'.$project->id) }}" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>
				<a href="{{ url('/'.Request::segment(1).'/'.$project->id) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
				<a href="{{ url('/project/') }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection
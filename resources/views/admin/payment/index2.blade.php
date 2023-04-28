@extends('admin.layout')
@section('konten')

@section('style')
<style>
	#detail-state td,
	#detail-state tr {
		border: none;
	}

	#detail-state tr:nth-child(2) {
		font-size: 20px;
		font-weight: bold;
	}
</style>
@endsection

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
								
								<div class="col s12" style="overflow-x:auto;margin-top:-20px">
									<table class="highlight" id="detail-state">
										<tr>
											<td>Nilai Jasa :<br><b style="font-size: 20px;">{{ number_format($project_detail->service_value, 0, ',', '.') }}</b></td>
											<td>Diskon :<br><b style="font-size: 20px;">{{ number_format($project->discount, 0, ',', '.') }}</b></td>
											<td>Total Bayar :<br><b style="font-size: 20px;">{{ number_format($project_detail->service_value-$project->discount, 0, ',', '.') }}</b></td>
											<td>Status :<br>
												@if($project_detail->service_value-$project->discount==$sum_payment)
													<span class="new badge green" data-badge-caption="LUNAS"></span>
												@else
													<span class="new badge red" data-badge-caption="BELUM LUNAS"></span>
												@endif
											</td>
										</tr>
									</table>
								</div>
								
								<div class="col s12 " style="overflow-x:auto;">
									<table class="highlight">
									<thead>
										<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
											<th style="width: 60px">No</th>
											<th>Tanggal</th>
											<th>Keterangan</th>
											<th>Pembayaran Panjar</th>
											<th>Sisa pembayaran</th>
											<th style="width: 20%">#aksi</th>
										</tr>
									</thead>
									<tbody>
										@php $total = $project_detail->service_value - $project->discount; @endphp
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td><p style="color:red">{{ number_format($total, 0, ',', '.') }}</p></td>
											<td></td>
										</tr>
										@php $total2 = 0 ;@endphp
										@foreach($payment as $v)
										@php $total2 = $total2 + $v->down_payment; @endphp
										<tr>
											<td>{{ $loop->index + 1 }}</td>
											<td>{{ date('d-m-Y', strtotime($v->date)) }}</td>
											<td>{{ $v->desc }}</td>
											<td>{{ number_format($v->down_payment, 0, ',', '.') }}</td>
											<td><p style="color:@if(($total - $total2)==0) green @else red @endif">{{ number_format($total - $total2, 0, ',', '.') }}</p></td>
											<td>
												<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/edit/'.$project->id.'/'.$v->id ) }}">Edit</a>
												<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/hapus/'.$project->id.'/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
											</td>
										</tr>
										@endforeach
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
				<a href="{{ url('/'.Request::segment(1).'/create/'.$project->id) }}" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>
				<a href="{{ url('/'.Request::segment(1).'/'.$project->id) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
				<a href="{{ url('/payment/'.$project->id) }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection
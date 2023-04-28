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
									<div class="card-title content-right">
										<div class="col s12">
											<form action="{{ url('/'.Request::segment(1).'/search') }}" method="GET">
												<div class="col s12" id="view-input-fields">
													<div class="input-field col s4 m4 l4">
														<label for="search">{{ __('Pencarian') }}</label>
														<input type="search" id="search" name="search" value="{{ request()->get('search') }}">
													</div>
													<div class="input-field col s3 m3 l3">
														<label for="work_date">{{ __('Tanggal Pengerjaan') }}</label>
														@php
        														$d = substr(request()->get('work_date'),3,2);
        														$m = substr(request()->get('work_date'),0,2);
        														$y = substr(request()->get('work_date'),6,4);
														@endphp
														<input type="text" id="work_date" class="datepicker" name="work_date" value="@if(request()->get('work_date')) {{ $d }}-{{ $m }}-{{ $y }} @endif">
													</div>
													<div class="input-field col s3 m3 l3">
														<select class="select2 browser-default" name="status">
															<option value="">- Status Pekerjaan -</option>
															<option value="ON LIST" @if(request()->get('status')== 'ON LIST') selected @endif>Belum Dikerjakan</option>
															<option value="ON PROGRESS" @if(request()->get('status')== 'ON PROGRESS') selected @endif>Sedang Dalam Pengerjaan</option>
															<option value="DONE" @if(request()->get('status')== 'DONE') selected @endif>Selesai</option>
														</select>
													</div>
													<div class="input-field col s2 m2 l2" style="padding-top:10px">
														<button type="submit" class="mb-12 btn waves-effect waves-light blue darken-1 btn-medium btn-block" >Lihat&nbsp;Project</button>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="card-title content-right">

									</div>
									@can('read-data')
									<div id="view-borderless-table ">
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

											<div class="col s12 " style="overflow-x:auto;">
												<table class="highlight">
													<thead>
														<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
															<th style="width: 60px">No</th>
															<th>Nama Project</th>
															<th style="width: 25%">Client</th>
															{{-- <th>Jumlah Pekerjaan</th> --}}
															<th style="width: 25%">Pekerjaan</th>
															<th style="width: 20%">TIM</th>
															<th style="width: 10%">Status</th>
															<th style="width: 25%">#aksi</th>
														</tr>
													</thead>
													<tbody>
														@foreach($project as $i => $v)
														<tr>
															<td>{{ ($project ->currentpage()-1) * $project ->perpage() + $loop->index + 1 }}</td>
															<td>{{ $v->project_name }}</td>
															<td><b>{{ $v->client_name }}</b><br>No.HP : {{ $v->phone }}<br>Alamat : {{ $v->address }}</td>
															{{--<td> @if($v->project_detail->count()==0)
																<span class="new badge red" data-badge-caption="{{ $v->project_detail->count() }}"></span>
																@else
																<span class="new badge green" data-badge-caption="{{ $v->project_detail->count() }}"></span>
																@endif
															</td>--}}
															
															<td>	
																<table>
																	@foreach($v->project_detail as $x)
																	<tr>
																		<td style="padding: 1px 5px;width:50%;border: 0px solid #f4f4f4;">
																			@if($x->status=='ON PROGRESS')
																				{{ $x->work_name }}<br>
																			@elseif($x->status=='DONE')
																				{{ $x->work_name }}<br>
																			@else
																				{{ $x->work_name }}<br>
																			@endif
																		</td>
																		<td style="padding: 1px 5px;width:50%;border: 0px solid #f4f4f4;">
																			@if($x->status=='ON PROGRESS')
																				: <span class="new badge orange" data-badge-caption="Dalam Proses Pengerjaan"></span><br>
																			@elseif($x->status=='DONE')
																				: <span class="new badge green" data-badge-caption="Selesai"></span><br>
																			@else
																				: <span class="new badge red" data-badge-caption="Belum waktu pengerjaan"></span><br>
																			@endif
																		</td>
																	</tr>
																	@endforeach
																</table>
															</td>
															<td>	
																<table>
																	@foreach($v->project_detail as $x)
																		<tr>
																			<td style="padding: 1px 5px;width:50%;border: 0px solid #f4f4f4;">{{ $x->work_name }}</td>
																			<td style="padding: 1px 5px;width:50%;border: 0px solid #f4f4f4;">: {{ $x->team->team_name }}</td>
																		</tr>
																	@endforeach
																</table>
															</td>
															<td>
																@if($project_detail[$i]->service_value-$v->discount==$sum_payment[$i])
																	<span class="new badge green" data-badge-caption="LUNAS"></span>
																@else
																	<span class="new badge red" data-badge-caption="BELUM&nbsp;LUNAS"></span>
																@endif
															</td>
															<td>
																<div class="col s12 m12 l12" style="display: block;padding-top:7px">
																	@if(Request::segment(1)=='project')
																		<a class="btn mb-12 btn waves-effect waves-light blue darken-1 btn-small btn-block" href="{{ url('/project-detail/' . $v->id) }}" style="padding-bottom:10px">Detail</a>
																		<a class="btn mb-12 btn waves-effect waves-light cyan darken-1 btn-small btn-block modal-trigger" style="margin-top:5px" href="#modal{{$v->id}}" style="padding-bottom:10px">Invoice</a>
																		<a class="btn mb-12 btn waves-effect waves-light cyan darken-1 btn-small btn-block" style="margin-top:5px" href="{{ url('/material/'.$v->id ) }}">Belanja Material</a>
																		<a class="btn mb-12 btn waves-effect waves-light cyan darken-1 btn-small btn-block" style="margin-top:5px" href="{{ url('/payment/'.$v->id ) }}">Pembayaran</a>
																		@can('ubah-data')
																			<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small btn-block" style="margin-top:5px" href="{{ url('/'.Request::segment(1).'/edit/'.$v->id ) }}">Edit</a>
																		@endcan
																		@can('hapus-data')
																			<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small btn-block" style="margin-top:5px" href="{{ url('/'.Request::segment(1).'/hapus/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
																		@endcan
																	@else
																		<a class="mb-12 btn waves-effect waves-light blue darken-1 btn-small btn-block" style="margin-top:5px" href="{{ url('/'.Request::segment(1).'/restore_data/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Kembalikan Data</a>
																	@endif
																</div>
															</td>
														</tr>

														<form action="{{ url('/'.Request::segment(1).'/invoice') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
														{{ csrf_field() }}
									
														<div id="modal{{$v->id}}" class="modal" style="max-height: 87%;width: 40%;">
															<div class="modal-content">
																<h5>Cetak Invoice</h5>
																<div id="view-borderless-table ">
																	<div class="row">
																		<input type="hidden"  name="project_id" value="{{ $v->id }}">
																		<select class="browser-default" name="invoice" required>
																			<option value="">- Pilih Invoice -</option>
																			<option value="1">Invoice Client</option>
																			<option value="2">Invoice Pembayaran Tukang</option>
																			<option value="3">Invoice Pembelian Material</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button class="mb-12 btn waves-effect waves-light blue darken-1">Cetak</button>
																<a class="modal-action modal-close mb-12 btn waves-effect waves-light red darken-1">Tutup</a>
															</div>
														</div>
														</form>

														@endforeach
													</tbody>
												</table>
												<div class="float-right">{{ $project->appends(Request::only('search','work_date','status'))->links() }}</div>
											</div>
										</div>
									</div>
									@endcan
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style="bottom: 40px; right: 19px;" class="fixed-action-btn direction-top">
					@if(Request::segment(1)=='project')
						@can('tambah-data')
						<a href="{{ url('/'.Request::segment(1).'/create') }}" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>
						@endcan
					@endif
					<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
				</div>
			</div>
			<div class="content-overlay"></div>
		</div>
	</div>
</div>
<!-- END: Page Main-->
<script>
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
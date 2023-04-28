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
									<form action="{{ url('/'.Request::segment(1).'/search/'.$project->id) }}" method="GET">
										<div class="app-file-header-search">
											<div class="input-field m-0">
											<i class="material-icons prefix">search</i>
												<input type="search" id="email-search" placeholder="Pencarian" name="search" style="border-bottom: 1px solid #e2dfdf;">
											</div>
										</div>
									</form>
								</div>
							</div><br><br><br>
							<div id="view-borderless-table ">
							<div class="row">

								<div class="input-field col s4">
									<label for="dtl-user">{{ __('Nama Project:') }}</label>
									<input type="text" id="dtl-user" value="{{ $project->project_name }} " readonly>
								</div>
								
								<div class="input-field col s4" >
									<label for="purchase-transaction-id">{{ __('Nama Client:') }}</label>
									<input type="text" value="{{ $project->client_name }}" readonly>
								</div>

								<div class="input-field col s4">
									<label for="dtl-user">{{ __('No HP:') }}</label>
									<input type="text" id="dtl-user" value="{{ $project->phone }} " readonly>
								</div>
								
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
											<th>Nama Pekerjaan</th>
											<th>Waktu Kerja</th>
											<th>Estimasi (Hari)</th>
											<th>Status Pekerjaan</th>
											<th>Tim</th>
											<th style="width: 15%">#aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach($project_detail as $v)
										<tr>
											<td>{{ ($project_detail ->currentpage()-1) * $project_detail ->perpage() + $loop->index + 1 }}</td>
											<td>{{ $v->work_name }}</td>
											<td>Mulai <b>{{ date('d-m-Y', strtotime($v->work_start)) }}</b><br> Sampai <b>{{ date('d-m-Y', strtotime($v->work_end)) }}</b></td>
											<td>{{ $v->estimation }} Hari</td>
											<td>
												@if($v->status=='ON PROGRESS')
													<span class="new badge orange" data-badge-caption="Dalam Proses Pengerjaan"></span><br>
												@elseif($v->status=='DONE')
													<span class="new badge green" data-badge-caption="Selesai"></span><br>
												@else
													<span class="new badge red" data-badge-caption="Belum waktu pengerjaan"></span><br>
												@endif
											</td>
											<td>{{ $v->team->team_name }}</td>
											<td>
												<a class="mb-12 btn waves-effect waves-light blue darken-1 btn-small btn-block modal-trigger" href="#modal{{$v->id}}">Detail</a>
												<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small btn-block" style="margin-top:5px" href="{{ url('/'.Request::segment(1).'/edit/'.$project->id.'/'.$v->id ) }}">Edit</a>
												<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small btn-block" style="margin-top:5px" href="{{ url('/'.Request::segment(1).'/hapus/'.$project->id.'/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
											</td>
										</tr>
										@endforeach
									</tbody>
									</table>

									@foreach($project_detail as $v)
									<!-- Modal Structure -->
									
									<form action="{{ url('/'.Request::segment(1).'/edit_status/'.$project->id.'/'.$v->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="PUT">
									
									<div id="modal{{$v->id}}" class="modal" style="max-height: 87%;">
										<div class="modal-content">
											<h5>Data Pekerjaan</h5>
											<div id="view-borderless-table ">
												<div class="row">
													<div class="col s12 " style="overflow-x:auto;">
													<table class="highlight">
														<tbody>
															<tr>
																<td style="width:20%">Nama Pekerjaan</td>
																<td  style="width:80%">: {{ $v->work_name }}</td>
															</tr>
															<tr>
																<td>Deskripsi</td>
																<td>: {{ $v->description }}</td>
															</tr>
															<tr>
																<td>Nilai Jasa</td>
																<td>: Rp. {{ number_format($v->service_value, 0, ',', '.') }}</td>
															</tr>
															<tr>
																<td>Volume</td>
																<td>: {{ number_format($v->volume, 0, ',', '.') }}</td>
															</tr>
															<tr>
																<td>Waktu Kerja</td>
																<td>: Tanggal <b>{{ date('d-m-Y', strtotime($v->work_start)) }}</b> Sampai <b>{{ date('d-m-Y', strtotime($v->work_end)) }}</b></td>
															</tr>
															<tr>
																<td>Estimasi (Hari)</td>
																<td>: {{ $v->estimation }} Hari</td>
															</tr>
															<tr>
																<td>TIM</td>
																<td>: {{ $v->team->team_name }}</td>
															</tr>
															<tr>
																<td>Gambar</td>
																<td>
																@if($v->image)
																	<a href="{{ asset('storage/upload/project_image/thumbnail/'.$v->image) }}" target="_blank"><img src="{{ asset('storage/upload/project_image/thumbnail/'.$v->image) }}" class="img-circle" alt="User Image"  width="100px" height="100px"></a>
																@else
																	<a href="{{ asset('upload/product/dummy-img.png') }}" target="_blank"><img src="{{ asset('upload/product/dummy-img.png') }}" class="img-circle" alt="User Image" width="100px" height="100px"></a>
																@endif
															</td>
															<tr>
																<td>Status</td>
																<td>
																	<select class="browser-default" name="status">
																		<option value="ON PROGRESS" @if($v->status=='ON PROGRESS') selected @endif>Dalam Proses Pengerjaan</option>
																		<option value="DONE" @if($v->status=='DONE') selected @endif>Selesai</option>
																	</select>
																</td>
															</tr>
														</tbody>
													</table>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="mb-12 btn waves-effect waves-light green darken-1">Simpan</button>
											<a href="#!" class="modal-action modal-close mb-12 btn waves-effect waves-light red darken-1">Tutup</a>
										</div>
									</div>
									</form>
									@endforeach

									<div class="float-right">{{ $project_detail->appends(Request::only('search'))->links() }}</div>
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
				<a href="{{ url('/project') }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
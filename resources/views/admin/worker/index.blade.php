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
							<div id="view-borderless-table ">
							<div class="row">

								<div class="input-field col s12">
									<label for="dtl-user">{{ __('Nama Tim:') }}</label>
									<input type="text" id="dtl-user" value="{{ $team->team_name }} " readonly>
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
											<th>Nama Aplicator</th>
											<th style="width: 35%">#aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach($worker as $v)
										<tr>
											<td>{{ ($worker ->currentpage()-1) * $worker ->perpage() + $loop->index + 1 }}</td>
											<td>{{ $v->worker_name }}</td>
											<td>
												<a class="mb-12 btn waves-effect waves-light blue darken-1 btn-small" href="{{ url('/worker_payment/'.$team->id.'/'.$v->id ) }}">Gaji Aplicator</a>
												<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/edit/'.$team->id.'/'.$v->id ) }}">Edit</a>
												<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/hapus/'.$team->id.'/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
											</td>
										</tr>
										@endforeach
									</tbody>
									</table>

									<div class="float-right">{{ $worker->appends(Request::only('search'))->links() }}</div>
								</div>
							</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
			<div style="bottom: 40px; right: 19px;" class="fixed-action-btn direction-top">
				<a href="{{ url('/'.Request::segment(1).'/create/'.$team->id) }}" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>
				<a href="{{ url('/'.Request::segment(1).'/'.$team->id) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
				<a href="{{ url('/team') }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
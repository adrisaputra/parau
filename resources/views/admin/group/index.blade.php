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
										<div class="app-file-header-search">
											<div class="input-field m-0">
											<i class="material-icons prefix">search</i>
												<input type="search" id="email-search" placeholder="Pencarian" name="search" style="border-bottom: 1px solid #e2dfdf;">
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
											<th>Nama Group</th>
											<th style="width: 25%">#aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach($group as $v)
										<tr>
											<td>{{ ($group ->currentpage()-1) * $group ->perpage() + $loop->index + 1 }}</td>
											<td>{{ $v->group_name }}</td>
											<td>
												<a class="mb-12 btn waves-effect waves-light cyan darken-1 btn-small" href="{{ url('/menu_akses/'.$v->id ) }}">Menu Akses</a>
												@can('ubah-data')
													<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/edit/'.$v->id ) }}">Edit</a>
												@endcan
												@can('hapus-data')
													<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small" href="{{ url('/'.Request::segment(1).'/hapus/'.$v->id ) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												@endcan
											</td>
										</tr>
										@endforeach
									</tbody>
									</table>
									<div class="float-right">{{ $group->appends(Request::only('search'))->links() }}</div>
								</div>
							</div>
							</div>
							@endcan
						</div>
						</div>
					</div>
				</div>
			</div>
			<div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
				@can('tambah-data')
					<a href="{{ url('/'.Request::segment(1).'/create') }}" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>
				@endcan
				<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
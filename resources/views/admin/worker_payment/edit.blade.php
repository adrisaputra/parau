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
	   
	   	<form action="{{ url('/'.Request::segment(1).'/edit/'.$team->id.'/'.$worker->id.'/'.$worker_payment->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
									<p style="text-align:center;font-size:20px;font-weight:bold">Edit {{ __($title) }}</p><br>
									
									<div class="input-field col s12">
											<label for="desc">{{ __('Nama Aplicator') }}</label>
											<input type="text" id="desc"  value="{{ $worker->worker_name }}" readonly>
										</div>

										<div class="input-field col s12">
											<label for="desc">{{ __('Keterangan') }}</label>
											<input type="text" id="desc" name="desc" value="{{ $worker_payment->desc }}" style="@if ($errors->has('desc'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('desc'))<small><div class="error">{{ $errors->first('desc') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<label for="down_payment">{{ __('Jumlah Panjar (Rp.)') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="down_payment" name="down_payment" value="{{ number_format($worker_payment->down_payment, 0, ',', '.') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('down_payment'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('down_payment'))<small><div class="error">{{ $errors->first('down_payment') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<label for="date">{{ __('Tanggal') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="date" onChange="getNumberOfDays()" class="datepicker" name="date" value="{{ $worker_payment->date }}" style="@if ($errors->has('date'))border-bottom: 2px solid #ff5252;@else color: black; @endif" readonly>
											@if ($errors->has('date'))<small><div class="error">{{ $errors->first('date') }}</div></small>@endif
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
				<a href="{{ url('/'.Request::segment(1).'/'.$team->id.'/'.$worker->id) }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
		</form>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
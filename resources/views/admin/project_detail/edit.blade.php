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
	   
	   	<form action="{{ url('/'.Request::segment(1).'/edit/'.$project->id.'/'.$project_detail->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
									<p style="text-align:center;font-size:20px;font-weight:bold">Edit {{ __($title) }}</p>
									
									<div class="input-field col s12">
										<label for="project_name">{{ __('Nama Project') }}</label>
										<input type="text" id="project_name" name="project_name" value="{{ $project->project_name }}" disabled style="color:black">
									</div>

									<div class="input-field col s12">
										<label for="client_name">{{ __('Nama Client') }}</label>
										<input type="text" id="client_name" name="client_name" value="{{ $project->client_name }}" disabled style="color:black">
									</div>

									<div class="input-field col s12">
										<label for="phone">{{ __('Nomor Telepon') }}</label>
										<input type="text" id="phone" name="phone" value="{{ $project->phone }}" disabled style="color:black">
									</div>

									<div class="input-field col s12">
										<label for="address">{{ __('Alamat') }}</label>
										<input type="text" id="address" name="address" value="{{ $project->address }}" disabled style="color:black">
									</div>

									<div class="input-field col s6">
										<label for="work_name">{{ __('Nama Pekerjaan') }} <span class="required" style="color: #dd4b39;">*</span></label>
										<input type="text" id="work_name" name="work_name" value="{{ $project_detail->work_name }}" style="@if ($errors->has('work_name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										@if ($errors->has('work_name'))<small><div class="error">{{ $errors->first('work_name') }}</div></small>@endif
									</div>

									<div class="input-field col s6">
										<div class="file-field input-field">
											<div class="btn waves-light cyan darken-0" style="line-height: 2rem;float: left;height: 2rem;">
												<span>Upload Gambar</span>
												<input type="file" name="image" >
											</div>
											<div class="file-path-wrapper">
												<input class="file-path validate" type="text" style="height: 2rem;">
											</div>
										</div>
										@if($project_detail->image)
											<img src="{{ asset('storage/upload/project_image/thumbnail/'.$project_detail->image) }}" width="100px" height="100px">
										@endif
									</div>

									<div class="input-field col s12">
										<label for="description">{{ __('Deskripsi Pekerjaan') }}</label>
										<input type="text" id="description" name="description" value="{{ $project_detail->description }}" style="@if ($errors->has('description'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										@if ($errors->has('description'))<small><div class="error">{{ $errors->first('description') }}</div></small>@endif
									</div>

									<div class="input-field col s6">
										<label for="service_value">{{ __('Nilai Jasa') }} <span class="required" style="color: #dd4b39;">*</span></label>
										<input type="text" id="service_value" name="service_value" value="{{ number_format($project_detail->service_value, 0, ',', '.') }}" onkeyup="formatRupiah(this, '.')" style="@if ($errors->has('service_value'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										@if ($errors->has('service_value'))<small><div class="error">{{ $errors->first('service_value') }}</div></small>@endif
									</div>

									<div class="input-field col s6">
										<label for="volume">{{ __('Volume') }} <span class="required" style="color: #dd4b39;">*</span></label>
										<input type="text" id="volume" name="volume" value="{{ $project_detail->volume }}" style="@if ($errors->has('volume'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										@if ($errors->has('volume'))<small><div class="error">{{ $errors->first('volume') }}</div></small>@endif
									</div>

									<div class="input-field col s4">
										<label for="work_start">{{ __('Waktu Mulai') }} <span class="required" style="color: #dd4b39;">*</span></label>
										<input type="text" id="work_start" onChange="getNumberOfDays()" class="datepicker" name="work_start" value="{{ $project_detail->work_start }}" style="@if ($errors->has('work_start'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										@if ($errors->has('work_start'))<small><div class="error">{{ $errors->first('work_start') }}</div></small>@endif
									</div>

									<div class="input-field col s4">
										<label for="work_end">{{ __('Waktu Selesai') }} <span class="required" style="color: #dd4b39;">*</span></label>
										<input type="text" id="work_end" onChange="getNumberOfDays()" class="datepicker2" name="work_end" value="{{ $project_detail->work_end }}" style="@if ($errors->has('work_end'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										@if ($errors->has('work_end'))<small><div class="error">{{ $errors->first('work_end') }}</div></small>@endif
									</div>

									<div class="input-field col s4">
										<label for="estimation">{{ __('Estimasi (Hari)') }}</label>
										<input type="text" id="estimation" name="estimation" value="{{ $project_detail->estimation }}" readonly style="color:black">
									</div>

									<div class="input-field col s12">
										<select class="select2 browser-default" name="team_id" id="team_id">
											<option value="">- Pilih TIM -</option>
											@foreach($team as $v)
												<option value="{{ $v->id }}" @if($project_detail->team_id=="$v->id") selected @endif>{{ $v->team_name }}</option>
											@endforeach
										</select>
										@if ($errors->has('team_id'))<small><div class="error">{{ $errors->first('team_id') }}</div></small>@endif
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
	function getNumberOfDays() {

		work_start = document.getElementById("work_start").value;
		work_end = document.getElementById("work_end").value;

		start_d = work_start.substr(0,2);
		start_m = work_start.substr(3,2);
		start_y = work_start.substr(6,4);
		var day_start = new Date(start_y+'-'+start_m+'-'+start_d);

		end_d = work_end.substr(0,2);
		end_m = work_end.substr(3,2);
		end_y = work_end.substr(6,4);
		var day_end = new Date(end_y+'-'+end_m+'-'+end_d);
		var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);

		if(work_start && work_end){
			document.getElementById("estimation").value = Math.round(total_days+1);
		} else {
			document.getElementById("estimation").value = 0;
		}
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
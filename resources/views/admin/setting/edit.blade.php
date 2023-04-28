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

            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <!-- Borderless Table -->
                        <div class="row">
                            <div class="col s12">
                                <div id="input-fields" class="card card-tabs">
                                    <div class="card-content">
										<div id="view-input-fields">
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
												
												<form action="{{ url('/'.Request::segment(1).'/edit/'.$setting->id) }}" method="POST" enctype="multipart/form-data" class="row">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="PUT">
													<div class="col s6">
														<div class="input-field col s12">
															<input value="{{ $setting->nama_aplikasi }}" name="nama_aplikasi" type="text" class="validate" style="color: black;">
															<label >{{ __('Nama Aplikasi') }}</label>
														</div>
													</div>
													<div class="col s6">
														<div class="input-field col s12">
															<input value="{{ $setting->singkatan_nama_aplikasi }}" name="singkatan_nama_aplikasi" type="text" class="validate" style="color: black;">
															<label >{{ __('Singkatan Nama Aplikasi') }}</label>
														</div>
														<div class="form-group @if ($errors->has('group')) has-error @endif">
															<label class="col-sm-2 control-label"></label>
															<div class="col-sm-10">
																<div>
																	<button type="submit" class="btn waves-effect waves-light cyan darken-1 float-right" title="Tambah Data"> Simpan</button>
																</div>
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
                    <div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
                        <a href="{{ url('setting') }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>

			<div class="col s12">
                <div class="container">
                    <div class="section">
                        <!-- Borderless Table -->
                        <div class="row">
                            <div class="col s12">
								<h5>Pengaturan Gambar</h5>
                                <div id="input-fields" class="card card-tabs">
                                    <div class="card-content">
										<div id="view-input-fields">
											<div class="row">
												<form action="{{ url('/'.Request::segment(1).'/edit/'.$setting->id) }}" method="POST" enctype="multipart/form-data" class="row">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="PUT">
													<div class="col s6">
															<div class="form-group @if ($errors->has('logo_kecil')) has-error @endif">
																<label class="col-sm-2 control-label">{{ __('Logo Kecil') }}</label>
																<div class="col-sm-10">
																	@if ($errors->has('logo_kecil'))<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('logo_kecil') }}</label>@endif
																	<input type="file" class="form-control" name="logo_kecil" value="{{ $setting->logo_kecil }}" >
																	<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
																	@if($setting->logo_kecil)
																		<br>
																		<img src="{{ asset('upload/setting/'.$setting->logo_kecil) }}" width="50px" height="50px">
																	@endif
																</div>
															</div>
															<hr>
															<div class="form-group @if ($errors->has('logo_besar')) has-error @endif">
																<label class="col-sm-2 control-label">{{ __('Logo Besar') }}</label>
																<div class="col-sm-10">
																	@if ($errors->has('logo_besar'))<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('logo_besar') }}</label>@endif
																	<input type="file" class="form-control" name="logo_besar" value="{{ $setting->logo_besar }}" >
																	<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
																	@if($setting->logo_besar)
																		<br>
																		<img src="{{ asset('upload/setting/'.$setting->logo_besar) }}" width="200px" height="50px">
																	@endif
																</div>
															</div>
													</div>
													<div class="col s6">
															<div class="form-group @if ($errors->has('background_login')) has-error @endif">
																<label class="col-sm-2 control-label">{{ __('Background Login') }}</label>
																<div class="col-sm-10">
																	@if ($errors->has('background_login'))<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('background_login') }}</label>@endif
																	<input type="file" class="form-control" name="background_login" value="{{ $setting->background_login }}" >
																	<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
																	@if($setting->background_login)
																		<br>
																		<img src="{{ asset('upload/setting/'.$setting->background_login) }}" height="50px">
																	@endif
																</div>
															</div>
															<hr>
															
															<div class="form-group @if ($errors->has('group')) has-error @endif">
																<label class="col-sm-2 control-label"></label>
																<div class="col-sm-10">
																	<div>
																		<button type="submit" class="btn waves-effect waves-light cyan darken-1 float-right" title="Tambah Data"> Simpan</button>
																	</div>
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
            </div>

        </div>
    </div>
    <!-- END: Page Main-->


@endsection
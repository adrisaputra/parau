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

            <form action="{{ url('/' . Request::segment(1) . '/edit/' . $supplier->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                                                        <div class="col s12">

                                                            <div class="input-field col s12">
                                                                <label for="supplier_name">{{ __('Nama Produk') }}</label>
                                                                <input type="text" id="supplier_name" name="supplier_name" value="{{ $supplier->supplier_name }}" style="@if ($errors->has('supplier_name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
                                                                @if ($errors->has('supplier_name'))<small><div class="error">{{ $errors->first('supplier_name') }}</div></small>@endif
                                                            </div>
                                                            <div class="input-field col s12">
                                                                <label for="phone">{{ __('Nomor Telepon') }}</label>
                                                                <input type="text" id="phone" name="phone" value="{{ $supplier->phone }}" style="@if ($errors->has('phone'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
                                                                @if ($errors->has('phone'))<small><div class="error">{{ $errors->first('phone') }}</div></small>@endif
                                                            </div>

                                                            <div class="input-field col s12">
                                                                <label for="address">{{ __('Alamat') }}</label>
                                                                <input type="text" id="address" name="address" value="{{ $supplier->address }}" style="@if ($errors->has('address'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
                                                                @if ($errors->has('address'))<small><div class="error">{{ $errors->first('address') }}</div></small>@endif
                                                            </div>

                                                            <div class="input-field col s12">
                                                                <label for="description">{{ __('Deskripsi') }}</label>
                                                                <input type="text" id="description" name="description" value="{{ $supplier->description }}" style="@if ($errors->has('description'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
                                                                @if ($errors->has('description'))<small><div class="error">{{ $errors->first('description') }}</div></small>@endif
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
                    <div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
                        <button type="submit" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">save</i></button>
                        <a href="{{ url()->previous() }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
                    </div>
                </div>
            </form>
            <div class="content-overlay"></div>
        </div>
    </div>
    </div>
    <!-- END: Page Main-->

@endsection

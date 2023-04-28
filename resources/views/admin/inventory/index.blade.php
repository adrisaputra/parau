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
                                            <form action="{{ url('/' . Request::segment(1) . '/search') }}" method="GET">
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
                                                            <th>Kode Produk</th>
                                                            <th>Nama Produk</th>
                                                            <th>Tersedia</th>
                                                            <th>Stok Minimal</th>
                                                            <th>Stok Maksimal</th>
                                                            <th>Status Stok</th>
                                                            {{-- <th style="width: 20%">#aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        {{-- if null --}}
                                                        @if(!count($inventory))
                                                        <tr>
                                                            <td colspan="9">
                                                                <center>Data Kosong</center>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        {{-- endif null --}}

                                                        @foreach ($inventory as $row)
                                                        @php
                                                        $percent = round(($row->in_stock / $row->full_stock) * 100);
                                                        $color = 'grey';
                                                        $stock_color = '';
                                                        if($row->in_stock < $row->min_stock) $stock_color = 'red-text';
                                                            if ($percent < 33) $color='red' ; elseif ($percent < 66) $color='orange' ; else $color='green' ; @endphp <tr>
                                                                <td>{{ ($inventory->currentpage() - 1) * $inventory->perpage() + $loop->index + 1 }}</td>
                                                                <td>{{ $row->product->code }}</td>
                                                                <td>{{ $row->product->product_name }}</td>
                                                                <td class="{{ $stock_color }}"><b>{{ $row->in_stock }}</b></td>
                                                                <td>{{ $row->min_stock }}</td>
                                                                <td>{{ $row->full_stock }}</td>
                                                                <td>
                                                                    <div class="my-progress">
                                                                        <div class="my-progress-bar {{ $color }}" role="progressbar" style="width: {{ $percent }}%; color: white;font-size:14px" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                                                                            <b>{{ $percent }}%</b>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                </tr>
                                                                @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="float-right">{{ $inventory->appends(Request::only('search'))->links() }}</div>
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
                    <a href="{{ url('/' . Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- END: Page Main-->

@endsection
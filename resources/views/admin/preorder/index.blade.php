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
                                                            <th>Nomor Pre Order</th>
                                                            <th style="width: 20%">User</th>
                                                            <th>Supplier</th>
                                                            <th>Jumlah Produk</th>
                                                            <th>Total Harga (Rp)</th>
                                                            <th>Tanggal PO</th>
                                                            <th style="width: 20%">#aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($purchaseTransaction as $v)
                                                        @php $i = $loop->iteration; @endphp
                                                        <tr role="row" class="odd">
                                                            <td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td>
                                                            <td>{{ $v->transaction_number }}</td>
                                                            <td>{{ $v->user->name }}</td>
                                                            <td>{{ $v->supplier->supplier_name }}</td>
                                                            <td>{{ $v->purchase_detail->count() }}</td>
                                                            <td>{{ number_format($v->total_price, 0, ',', '.') }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($v->created_at)) }}</td>
                                                            <td class="p-1">
                                                                @can('ubah-data')
                                                                    <a class="btn mb-12 btn waves-effect waves-light blue darken-1 btn-small" href="{{ url('/' . Request::segment(1) . '/confirm/' . $v->id) }}">Konfirmasi</a>
                                                                @endcan
                                                                <a class="btn btn-small waves-effect waves-light red darken-1" onclick="return confirm('Are you sure?')" href="{{ url('/' . Request::segment(1) . '/hapus/' . $v->id) }}">Hapus</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="float-right">{{ $purchaseTransaction->appends(Request::only('search'))->links() }}</div>
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
                    @can('tambah-data')
                    <a href="{{ url('/' . Request::segment(1) . '/create') }}" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>
                    @endcan
                    <a href="{{ url('/' . Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script script src="{{ asset('/assets/preorder/js/helper-po.js') }}"></script>
<script script src="{{ asset('/assets/preorder/js/preorder.js') }}"></script>
@endsection
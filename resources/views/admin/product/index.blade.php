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
                                <div class="card-content animate fadeUp">
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

                                            <form action="{{ url('/'.Request::segment(1).'/print') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            {{ csrf_field() }}

                                            <div class="col s12 " style="overflow-x:auto;">
                                                <table class="highlight animate fadeUp">
                                                    <thead>
                                                        <tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
                                                            <th style="width: 5px">
                                                            <span style="padding-left: 25px;"></span>
                                                            <label><center><input onclick="toggle(this)" class="filled-in" type="checkbox" /> <span style="padding-left: 18px;"></span></center></label></th>
                                                            <th style="width: 60px">No</th>
                                                            <th>Gambar</th>
                                                            <th style="width: 20%">Kode Produk</th>
                                                            <th>Nama Produk</th>
                                                            <th>Harga Beli (Rp)</th>
                                                            <th>Harga Jual (Rp)</th>
                                                            <th>Kategori</th>
                                                            <th>Outlet</th>
                                                            <th style="width: 15%">#aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- if null --}}
                                                        @if(!count($product))<tr>
                                                            <td colspan="9">
                                                                <center>Data Kosong</center>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        {{-- endif null --}}

                                                        @foreach ($product as $v)
                                                        <tr>
                                                            <td><label><input type="checkbox" class="filled-in" name="product_id[]" value="{{ $v->id }}"/><span style="padding-left: 18px;"></span></center></label>
                                                            </td>
                                                            <td>{{ ($product->currentpage() - 1) * $product->perpage() + $loop->index + 1 }}</td>
                                                            <td>
                                                                @if($v->image)
                                                                <img src="{{ asset('storage/upload/product_image/thumbnail/'.$v->image) }}" class="img-circle" alt="User Image" width="100px" height="100px">
                                                                @else
                                                                <img src="{{ asset('upload/product/dummy-img.png') }}" class="img-circle" alt="User Image" width="100px" height="100px">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    @if ($v->code)
                                                                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($v->code, 'C128', 1.5, 70, [1, 1, 1], true) }}" alt="barcode" /> 
                                                                    @endif
                                                                </center>
                                                            </td>
                                                            <td>{{ $v->product_name }}</td>
                                                            <td>{{ number_format($v->purchase_price, 0, ',', '.') }}</td>
                                                            <td>{{ number_format($v->selling_price, 0, ',', '.') }}</td>
                                                            <td>
                                                                @php $count = count($v->product_category); @endphp
                                                                @foreach ($v->product_category as $t => $x)
                                                                {{ $x->category->category_name }}
                                                                @if ($t != $count - 1)
                                                                ,
                                                                @endif
                                                                @endforeach
                                                            </td>
                                                            <td>{{ $v->outlet->outlet_name }}</td>
                                                            <td>
                                                                @can('ubah-data')
                                                                <a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small" href="{{ url('/' . Request::segment(1) . '/edit/' . $v->id) }}">Edit</a>
                                                                @endcan
                                                                @can('hapus-data')
                                                                <a class="mb-12 btn waves-effect waves-light red darken-1 btn-small" href="{{ url('/' . Request::segment(1) . '/hapus/' . $v->id) }}" onclick="return confirm('Anda Yakin ?');">Hapus</a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="float-right">{{ $product->appends(Request::only('search'))->links() }}</div>
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
                    @can('print-data')
                    <button type="submit" class="btn-floating btn-large waves-effect waves-light blue darken-2"><i class="material-icons">print</i></button>
                    @endcan
                    <a href="{{ url('/' . Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
                </div>
            </div>
            </form>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- END: Page Main-->
<script type="text/javascript">
	function toggle(pilih) {
	  checkboxes = document.getElementsByName('product_id[]');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = pilih.checked;
	  }
}
</script>
@endsection
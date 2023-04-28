<html>
<head>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard-modern.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.css') }}">
  <style>
    @page { size: 47mm 45mm landscape; }
  </style>
</head>
<body>
  @php $jumlah = count($product_id);@endphp
  @for($i=0;$i<$jumlah;$i++) 
			@if($product[$i])
      <table style="height:45mm;width:45mm;margin-left:-80px;margin-top:-46px">
        <tr><th style="border-color: white;padding-top:-20px"><center>
          <p style="color:black;">{{ $product[$i]->product_name }}</p>
          <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product[$i]->code, 'C128', 1, 50, [1, 1, 1], true) }}" alt="barcode" /> 
        </center></th>
        </tr>
      </table>
      @endif
  @endfor

</body>
</html>
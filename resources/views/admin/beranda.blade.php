@extends('admin/layout')
@section('konten')

<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/bootstrap.js') }}"></script>

<!-- BEGIN: Page Main-->
<div id="main">
   <div class="row">
   <div class="content-wrapper-before gradient-45deg-light-blue-cyan"></div>
      <div class="col s12">
         <div class="container">
            <div class="section">
               <!-- Current balance & total transactions cards-->
               <div class="row vertical-modern-dashboard">
                  <div class="col s12 m12 l12">
                     <!-- Current Balance -->
                     <p class="animate fadeUp " style="font-size:28px;font-weight:bold;color:white;margin-top: -20px;margin-bottom: 10px;">Selamat Datang Di {{ $outlet->outlet_name }} </p>
                     <!-- card stats start -->
                     <div id="card-stats" class="pt-0">
                        <div class="row">
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp ">
                                 <div class="card-content blue white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-briefcase"></i> Jumlah Pekerjaan</p>
                                    <p style="font-size:40px">{{ number_format($total_project, 0, ',', '.') }}</p>
                                 </div>
                                 <div class="card-action blue darken-1">
                                    <div id="clients-bar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp ">
                                 <div class="card-content red white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-toolbox"></i> Belum Dikerjakan</p>
                                    <p style="font-size:40px">{{ number_format($on_list, 0, ',', '.') }}</p>
                                 </div>
                                 <div class="card-action red darken-1">
                                    <div id="clients-bar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp delay-1">
                                 <div class="card-content orange accent-2 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-sync"></i> Sedang Dikerjakan</p>
                                    <p style="font-size:40px">{{ number_format($on_progress, 0, ',', '.') }}</p>
                                 </div>
                                 <div class="card-action orange">
                                    <div id="sales-compositebar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp delay-2">
                                 <div class="card-content green lighten-1 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-check"></i> Selesai</p>
                                    <p style="font-size:40px">{{ number_format($done, 0, ',', '.') }}</p>
                                 </div>
                                 <div class="card-action green">
                                    <div id="invoice-line" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--card stats end-->
                  </div>
               </div>
               <!--/ Current balance & total transactions cards-->
               <!--work collections start-->
               <div id="work-collections">

                  <div class="row">
                     <div class="col s12 m12 l8">
                           <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">
                              <li class="collection-item avatar" style="padding-top: 10px;min-height: 60px;">
                                 <i class="material-icons cyan circle">room</i>
                                 <h6 class="collection-header m-0" style="padding-top: 12px;">Peta Sebaran</h6>
                              </li>
                              <li class="collection-item">
                                 <div class="row">
                                    <div id="googleMap" style="width:100%;height:500px;"></div>
                                    
                                    <a class="mb-12 btn waves-effect waves-light blue darken-1 btn-small modal-trigger" href="#modal" id="clickButton">Detail</a>
                                    
                                 </div>
                              </li>
                           </ul>
                     </div>
                     
                     <div class="col s12 m12 l4">
                           <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">
                              <li class="collection-item avatar" style="padding-top: 10px;min-height: 60px;">
                                 <i class="material-icons red accent-2 circle">list</i>
                                 <h6 class="collection-header m-0" style="padding-top: 12px;">Stok Produk Yang Menipis</h6>
                              </li>
                              <li class="collection-item">
                                 <div class="row">
                                       @if(count($product)>0)
                                          <div class="carousel" id="carousel">
                                             @foreach($product as $v)
                                                <div class="carousel-item">
                                                   <center><p style="font-weight:bold;font-size:20px;margin-bottom:0px">{{ $v->product_name}}</p></center>
                                                   @if($v->image)
                                                      <img src="{{ asset('storage/upload/product_image/thumbnail/'.$v->image) }}" class="d-block w-100" alt="...">
                                                   @else
                                                      <img src="{{ asset('upload/product/dummy-img.png') }}" class="d-block w-100" alt="...">
                                                   @endif
                                                   <center><p style="font-weight:bold;font-size:20px;margin-top:0px">Stok Saat Ini : <b style="color:red">{{ $v->inventory->in_stock}}</b><p></center>
                                                </div>
                                             @endforeach
                                          </div>
                                       @else
                                          <center><p style="font-weight:bold;font-size:20px;">Stok Aman</p></center>
                                       @endif
                                 </div>
                              </li>
                           </ul>
                     </div>

                     <div class="col s12 m12 l4">
                           <ul id="issues-collection" class="collection z-depth-1 animate fadeRight">
                              <li class="collection-item avatar" style="padding-top: 10px;min-height: 60px;">
                                 <i class="material-icons green accent-2 circle">event_note</i>
                                 <h6 class="collection-header m-0" style="padding-top: 12px;">Jadwal TIM</h6>
                              </li>
                              <li class="collection-item">
                                 <div class="row">
                                    <div class="col s7">
                                       <p class="collections-title">Tim A</p>
                                    </div>
                                    <div class="col s2"><span class="task-cat deep-orange accent-2">P1</span></div>
                                    <div class="col s3">
                                       <div class="progress">
                                          <div class="determinate" style="width: 70%"></div>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                     </div>
                     
                  </div>
               </div>
               <!--work collections end-->
               <div id="modal" class="modal" style="width: 70%;">
                     <div id="detail-modal"></div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
                           
<script>
$('.carousel').carousel({
    padding: 200    
});
autoplay();
function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 4500);
}
</script>  

<!-- Menyisipkan library Google Maps -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDk5azS8gZ2aDInOTqyPv7FmB5uBlu55RQ&callback=initMap"></script>

<script type="text/javascript">

	var map; 
	var lat_longs_map = new Array();
	var markers_map = new Array();
	var iw_map;

	iw_map = new google.maps.InfoWindow();

	function initialize_map() {

	var myLatlng = new google.maps.LatLng({{ $outlet->lat }}, {{ $outlet->long }});
	var myOptions = {
		zoom: 11,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.hybrid }
	map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
		
	@foreach($project as $v)	
	// Marker 1	
	var myLatlng = new google.maps.LatLng({{ $v->lat }}, {{ $v->long}});

	var pinColor = "#63cbf2";
    var pinLabel = "A";

    // Pick your pin (hole or no hole)
    var pinSVGHole = "M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z";
    var labelOriginHole = new google.maps.Point(12,15);
    var pinSVGFilled = "M 12,2 C 8.1340068,2 5,5.1340068 5,9 c 0,5.25 7,13 7,13 0,0 7,-7.75 7,-13 0,-3.8659932 -3.134007,-7 -7,-7 z";
    var labelOriginFilled =  new google.maps.Point(12,9);


    var markerImage = {  // https://developers.google.com/maps/documentation/javascript/reference/marker#MarkerLabel
        path: pinSVGHole,
        anchor: new google.maps.Point(12,25),
        fillOpacity: 1,
        fillColor: pinColor,
        strokeWeight: 2,
        strokeColor: "white",
        scale: 2,
        labelOrigin: new google.maps.Point(12,30),
    };
	
	var markerOptions = {
		map: map,
		position: myLatlng,
		// label: {
		// 	color: 'black',
		// 	fontWeight: 'bold',
		// 	text: '{{ $v->id }}',
		// 	fontSize: '12px',
		//   },
		icon: markerImage
	};
	
	marker_0 = createMarker_map(markerOptions);

		google.maps.event.addListener(marker_0, "click", function(event) {
         document.getElementById("clickButton").click();
			$.ajax(
            {
               url: "{{ url('/detail_peta/'.$v->id) }}", 
               success: function(result){
				      $("#detail-modal").html(result);
			      }
            })
		});

	@endforeach

	}


	function createMarker_map(markerOptions) {
	var marker = new google.maps.Marker(markerOptions);
	markers_map.push(marker);
	lat_longs_map.push(marker.getPosition());
	return marker;
	}

	google.maps.event.addDomListener(window, "load", initialize_map);


</script>
<script>
   document.getElementById("clickButton").style.visibility = "hidden";
</script>
@endsection
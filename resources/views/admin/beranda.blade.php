@extends('admin/layout')
@section('konten')

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
                     
                     <!-- card stats start -->
                     <div id="card-stats" class="pt-0">
                        <div class="row">
                           <div class="col s12 m6 l3">
                              <div class="card animate fadeUp ">
                                 <div class="card-content cyan white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-id-card"></i> Total Pegawai</p>
                                    <p style="font-size:40px">12</p>
                                 </div>
                                 <div class="card-action cyan darken-1">
                                    <div id="clients-bar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m6 l3">
                              <div class="card animate fadeUp delay-1">
                                 <div class="card-content red accent-2 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-user-times"></i> Pensiun</p>
                                    <p style="font-size:40px">12</p>
                                 </div>
                                 <div class="card-action red">
                                    <div id="sales-compositebar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m6 l3">
                              <div class="card animate fadeUp delay-2">
                                 <div class="card-content orange lighten-1 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-sort-amount-up"></i> Naik Pangkat</p>
                                    <p style="font-size:40px">12</p>
                                 </div>
                                 <div class="card-action orange">
                                    <div id="invoice-line" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m6 l3">
                              <div class="card animate fadeUp delay-3">
                                 <div class="card-content green lighten-1 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-birthday-cake"></i> Ulang Tahun</p>
                                    <p style="font-size:40px">12</p>
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
            </div>
         </div>
      </div>
   </div>
</div>
      
@endsection
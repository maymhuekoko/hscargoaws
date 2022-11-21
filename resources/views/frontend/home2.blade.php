@extends('../frontend/search')
@section('title', 'Home')
@section('content')

<!-- ============================================-->
    <!-- <section> begin ============================-->
        <section class="pb-6 mt-5" id="about">
            <!-- {{-- <span>#4568DC</span> --}} -->
                 <div class="container">
                   <div class="row offset-2 col-md-8">
                       <!-- {{-- <form action="{{route('tk_search')}}" method="POST" id="form_id">
                           @csrf --}} -->
                    <div class="input-group">
                        <input type="search" name="t" id="tk_ph" class="form-control rounded" placeholder="Enter Token or Phone Number" aria-label="Search" aria-describedby="search-addon">
                        <button type="button" class="btn btn-primary" onclick="show_det()">Track Parcel</button>
                      </div>
                    <!-- {{-- </form> --}} -->
                   </div>
                   <h6 class="text-center mt-5" style="">Start tracking your parcel by entering your phone number in the box above.</h6>

                   <div id="det" class="mt-4">

                   </div>

                   <div class=" offset-2 col-md-8" id="ph">
                   <table class="table table-striped">
                    <thead  class="thead-dark">
                      <th></th>
                      <th>Token</th>
                      <th>Route</th>
                      <th>Status</th>
                      <th>Location</th>
                      <th>Package Quantity</th>
                      <th>Total Charges</th>
                      <th>Action</th>
                    </thead>
                   <tbody id="list">
                  </tbody>
                   </table>
                   </div>

                  </div>
                 </div>


        </section>

        <section class="py-3" id="help">

            <div class="container">
              <h4 class="text-center mb-5">Company of &nbsp;&nbsp;&nbsp;<img src="{{asset('frontend/assets/img/logo20.jpg')}}" alt="" width="200"></h4>
              <div class="row">
                {{-- <div class="col-12 col-lg-4 mb-3"><a href="#"><img class="d-inline-block align-middle" src="{{asset('frontend/assets/img/icons/logo.png')}}" alt="" width="30" /><span class="d-inline-block text-1000 fs-1 ms-2 fw-medium lh-base">Lasles<span class="fw-bold">VPN</span></span></a>
                  <p class="my-3"> <span class="fw-medium">LaslesVPN </span>is a private virtual network that<br />has unique features and has high security. </p>
                  <ul class="list-unstyled list-inline">
                    <li class="list-inline-item"><a class="text-decoration-none" href="#!">
                        <svg class="bi bi-facebook" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                          <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                        </svg></a></li>
                    <li class="list-inline-item"><a href="#!">
                        <svg class="bi bi-twitter" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                          <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                        </svg></a></li>
                    <li class="list-inline-item"><a href="#!">
                        <svg class="bi bi-instagram" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                          <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"> </path>
                        </svg></a></li>
                  </ul>
                  <p class="text-400 my-3">&copy; 2020 Your Company</p>
                </div> --}}
                <div class="col-6 col-sm-4 col-lg-3 mb-3">
                  <h5 class="lh-lg"> <span style="background-color:rgb(247, 132, 38);color:#fff "> &nbsp;&nbsp;&nbsp; Bangkok &nbsp;&nbsp;&nbsp;</span></h5>
                  <ul class="list-unstyled mb-md-4 mb-lg-0">
                    @foreach ($contacts as $c)
                    @if ($c->location == "BKK")
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">{{$c->address}}</span></a></li>
                    
                    @endif
                      
                    @endforeach
                    @foreach ($contacts as $c)
                    @if ($c->location == "BKK")
                    
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">++{{$c->phone_number}}</span></a></li>
                    @endif
                      
                    @endforeach
                  </ul>
                </div>
                <div class="col-6 col-sm-4 col-lg-3 mb-3">
                  <h5 class="lh-lg"><span style="background-color:rgb(247, 132, 38);color:#fff "> &nbsp;&nbsp;&nbsp; Maesot &nbsp;&nbsp;&nbsp;</span></h5>
                  <ul class="list-unstyled mb-md-4 mb-lg-0">
                    @foreach ($contacts as $c)
                    @if ($c->location == "MAESOT")
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">{{$c->address}}</span></a></li>
                    
                    @endif
                      
                    @endforeach
                    @foreach ($contacts as $c)
                    @if ($c->location == "MAESOT")
                    
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">++{{$c->phone_number}}</span></a></li>
                    @endif
                      
                    @endforeach
                  </ul>
                </div>
                <div class="col-12 col-sm-4 col-lg-3 mb-3 ps-xxl-7 ps-xl-5">
                  <h5 class="lh-lg"><span style="background-color:rgb(247, 132, 38);color:#fff "> &nbsp;&nbsp;&nbsp; Yangon &nbsp;&nbsp;&nbsp;</span> </h5>
                  <ul class="list-unstyled mb-md-4 mb-lg-0">
                    @foreach ($contacts as $c)
                    @if ($c->location == "YGN")
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">{{$c->address}}</span></a></li>
                    
                    @endif
                      
                    @endforeach
                    @foreach ($contacts as $c)
                    @if ($c->location == "YGN")
                    
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">++{{$c->phone_number}}</span></a></li>
                    @endif
                      
                    @endforeach
                  </ul>
                </div>
                <div class="col-12 col-sm-4 col-lg-3 mb-3 ps-xxl-7 ps-xl-5">
                  <h5 class="lh-lg"><span style="background-color:rgb(247, 132, 38);color:#fff "> &nbsp;&nbsp;&nbsp; Myawaddy &nbsp;&nbsp;&nbsp;</span> </h5>
                  <ul class="list-unstyled mb-md-4 mb-lg-0">
                    @foreach ($contacts as $c)
                    @if ($c->location == "MYAWADY")
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">{{$c->address}}</span></a></li>
                    
                    @endif
                      
                    @endforeach
                    @foreach ($contacts as $c)
                    @if ($c->location == "MYAWADY")
                    
                    <li class="lh-lg"><a class="text-900 text-decoration-none" href="#!"><span style="font-style:italic;color:hsl(325, 64%, 50%)">++{{$c->phone_number}}</span></a></li>
                    @endif
                      
                    @endforeach
                  </ul>
                </div>
                {{-- <hr class="opacity-25" /> --}}
                {{-- <div class="text-400 text-center">
                  <p style="font-weight: bold;color:hsl(325, 64%, 50%)">This template is made with&nbsp;
                    <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                      <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                    </svg>&nbsp;by&nbsp;<a class="text-900" href="https://themewagon.com/" target="_blank"><span style="font-weight: bold;color:white">ThemeWagon</span></a>
                  </p>
                </div> --}}
              </div>
            </div>
            <!-- end of .container-->

          </section>

@endsection

@section('js')
<script>

$( document ).ready(function() {
    $('#ph').hide();
});

function show_det(){
// alert("dfjkd");

    var tk_ph = $('#tk_ph').val();
    var tk = 'T';
    if(tk_ph.startsWith(tk)){
      var typee = 1;
    }
    else{
      var typee = 2;
    }

    $.ajax({
           type:'POST',
           url:'/tk_search',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "tk_ph": typee,
                "tk" : tk_ph
            },

           success:function(data){
              //  alert(data.type);
              // alert(data.orders.customer_name[0]);
            var htmlcard = "";

            var htmlcard1 = "";
            var htmltable = "";
            $.each(data.orders, function(i, v) {
                // alert(v.customer_name);
              if(v.customer_date == null)
              {
                cust_date = "Updated Soon!";
              }
              else
              {
                cust_date = v.customer_date;
              }
              if(v.remark == null)
              {
                  var remark = 'မရှိ';
              }
              else
              {
                  var remark = v.remark;
              }
                var addre = v.customer_address;
               var re_addre = addre.split(",").pop();


               if(v.receive_point == 1){
                 var rec_point = 'BKK';
               }
              else if(v.receive_point ==2){
                var rec_point = 'YGN';
              }
              else if(v.receive_point == 3){
                var rec_point = 'MDY';
              }
               else if(v.receive_point == 4){
                var rec_point = 'Maesot';
              }
              if(v.dropoff_point == 1){
                 var drop_point = 'BKK';
               }
              else if(v.dropoff_point ==2){
                var drop_point = 'YGN';
              }
              else if(v.dropoff_point == 3){
                var drop_point = 'MDY';
              }
               else if(v.dropoff_point == 4){
                var drop_point = 'Maesot';
              }
              if(v.receive_status == 0){
                var rec_status = 'Not Received';
              }
              else if(v.receive_status == 1){
                var rec_status = 'Received';
              }
              if(v.myawady_status == 0){
                var mya_status = 'Not started';
              }
              else if(v.myawady_status == 1){
                var mya_status = 'On the Way';
              }
              else if(v.myawady_status == 2){
                var mya_status = 'Arrived';
              }
              if(v.dropoff_status == 0){
                var drop_status = 'Not started';
              }
              else if(v.dropoff_status == 1){
                var drop_status = 'On the Way';
              }
              else if(v.dropoff_status == 2){
                var drop_status = 'Arrived';
              }

              if(v.customer_status == 0){
                var cust_status = 'Not started';
              }
              else if(v.customer_status == 1){
                var cust_status = 'On the Way';
              }
              else if(v.customer_status == 2){
                var cust_status = 'Arrived';
              }
              else if(v.customer_status == 3){
                var cust_status = 'Collect';
              }
              else if(v.customer_status == 4){
                var cust_status = 'Lost';
              }

              if(v.way_status == 0 && v.customer_status == 3){
                var status = 'Collect';
              }
              if(v.way_status == 0 && v.customer_status == 4){
                var status = 'Lost';
              }
              else if(v.way_status == 0){
                var status = 'Pending';
              }
              else if(v.way_status == 1){
                var status = 'Done';
              }
              if((v.receive_status == 0 || v.receive_status == 1) && v.myawady_status != 2 && v.dropoff_status != 2 && v.customer_status !=2){
                var location = rec_point;
              }
              // else if(v.receive_status == 1 && v.myawady_status != 2 && v.dropoff_status != 2 && v.customer_status !=2){
              //   var location = rec_point;
              // }
              else if(v.receive_status == 1 && v.myawady_status == 2 && v.dropoff_status != 2 && v.customer_status !=2){
                var location = 'Myawady';
              }
              else if(v.receive_status == 1 && v.myawady_status == 2 && v.dropoff_status == 2 && v.customer_status !=2){
                var location = drop_point;
              }
              else if(v.receive_status == 1 && v.myawady_status == 2 && v.dropoff_status == 2 && v.customer_status ==2){
                var location = v.customer_address;
              }
                if(data.type == 1){
                  $('#ph').hide();
                  if(v.token == null){
                    var token = "-";
                  }else{
                    var token = v.token;
                  }
                  if(v.tracking_no == null){
                    var tracking_no = "-";
                  }else{
                    var tracking_no = v.tracking_no;
                  }
                  if(v.total_weight == null){
                    var total_weight = "-";
                  }else{
                    var total_weight = v.total_weight;
                  }
                  if(v.customer_date == null && (v.customer_status==3 || v.customer_status == 4)){
                        cust_date = "No Date";
                      }
                      else  if(v.customer_date == null)
                      {
                        cust_date = "Updated Soon!";
                      }
                      else
                      {
                        cust_date = v.customer_date;
                      }
                      if(v.myawady_date == null)
                      {
                        myawady_date = "No Date";
                      }
                      else
                      {
                        myawady_date = v.myawady_date;
                      }
                      if(v.dropoff_date == null)
                      {
                        dropoff_date = "No Date";
                      }
                      else
                      {
                        dropoff_date = v.dropoff_date;
                      }
                htmlcard += ` <div class="card order ">
                        <div class="title">Purchase Reciept</div>
                        <div class="info">
                            <div class="row">
                                <div class="col-4"> <span id="heading">BKK-MAESOT Date</span><br> <span id="details">${v.receive_date}</span> </div>
                                <div class="col-4 pull-right"> <span id="heading">Token No.</span><br> <span id="details">${token}</span> </div>
                                <div class="col-4 pull-right"> <span id="heading">Tracking No.</span><br> <span id="details">${tracking_no}</span> </div>
                            </div>
                        </div>
                        <div class="pricing">
                            <div class="row">
                                <div class="col-9"> <span id="name">Customer Name</span> </div>
                                <div class="col-3"> <span id="price">${v.customer_name}</span> </div>
                            </div>
                            <div class="row">
                                <div class="col-9"> <span id="name">Customer Phone Number</span> </div>
                                <div class="col-3"> <span id="price">${v.customer_phone}</span> </div>
                            </div>
                            <div class="row">
                                <div class="col-9"> <span id="name">Parcel Quantity</span> </div>
                                <div class="col-3"> <span id="price">${v.parcel_quantity}</span> </div>
                            </div>
                            <div class="row">
                                <div class="col-9"> <span id="name">Remark</span> </div>
                                <div class="col-3"> <span id="price">${remark}</span> </div>
                            </div>
                            
                        </div>
                        <div class="total">
                          <div class="row">
                                <div class="col-9"> <span id="name">Total Charges</span> </div>
                                <div class="col-3"> <span id="price">${v.total_charges}</span> </div>
                            </div>

          
                            
                            <div class="row">
                                <div class="col-9"> <span id="name">Total Weight</span> </div>
                                <div class="col-3"> <span id="price">${total_weight}</span> </div>
                              </div>
                        </div>
                        <div class="tracking mt-2">
                            <div class="title">Tracking Order</div>
                        </div>
                        <div class="progress-track">

                        </div>
                        <div class="pricing mt-2">
                            <strong id="name">Receive Point</strong>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3"><span class="border border-primary px-1" id="now">${rec_point}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${rec_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${v.receive_date}</span></div>
                            </div>
                        </div>
                        <div class="total mt-2">
                            <strong id="name">Border Point</strong>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3"><span class="border border-primary px-1" id="now">Myawaddy</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${mya_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${myawady_date}</span></div>
                            </div>
                        </div>
                        <div class="pricing">
                            <strong id="name">Dropoff Point</strong>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3"><span class="border border-primary px-1" id="now">${drop_point}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${drop_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${dropoff_date}</span></div>
                            </div>
                        </div>
                        <div class="total">

                            <strong id="name">Customer Point</strong>
                            <div class="row">
                                <div class="col-1"></div>

                                <div class="col-3"><span class="border border-primary px-1" id="now">${re_addre}</span></div>

                                <div class="col-4"><span class="border border-primary px-1" id="now">${cust_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${cust_date}</span></div>

                            </div>
                        </div>
                        <div class="footer pricing">
                            <div class="row">
                                <div class="col-10" style="font-size:13px;">Want any help? Please &nbsp;<a> contact us</a></div>
                            </div>
                        </div>
                    </div>`;


                    if( v.receive_status == 0 && v.myawady_status != 2 && v.dropoff_status != 2 && v.customer_status !=2){
                    htmlcard1 += `

                            <ul id="progressbar">
                                <li class="step0 " id="step1">Thai</li>
                                <li class="step0 text-center" id="step2">Myawady</li>
                                <li class="step0 text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }

                    else if( v.receive_status == 1 && v.myawady_status != 2 && v.dropoff_status != 2 && v.customer_status !=2){
                    htmlcard1 += `

                            <ul id="progressbar">
                                <li class="step0 active " id="step1">Thai</li>
                                <li class="step0 text-center" id="step2">Myawady</li>
                                <li class="step0 text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }
                    else if(v.receive_status == 1 && v.myawady_status == 2 && v.dropoff_status != 2 && v.customer_status !=2){
                    htmlcard1 += `

                            <ul id="progressbar">
                                <li class="step0  active" id="step1">Thai</li>
                                <li class="step0 active text-center" id="step2">Myawady</li>
                                <li class="step0 text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }
                    else if(v.receive_status == 1 && v.myawady_status == 2 && v.dropoff_status == 2 && v.customer_status !=2){
                    htmlcard1 += `

                            <ul id="progressbar">
                                <li class="step0  active" id="step1">Thai</li>
                                <li class="step0 active text-center" id="step2">Myawady</li>
                                <li class="step0 active text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }
                    else if(v.receive_status == 1 && v.myawady_status == 2 && v.dropoff_status == 2 && v.customer_status ==2){
                    htmlcard1 += `

                            <ul id="progressbar">
                                <li class="step0  active" id="step1">Thai</li>
                                <li class="step0 active text-center" id="step2">Myawady</li>
                                <li class="step0 active text-right" id="step3">On the way</li>
                                <li class="step0 active text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }

                }
                else{
                  $('#ph').show();
                  htmltable += `<tr>
                                <td><input type="checkbox" id="horns" name="customer" class="mt-2"> </td>
                                <td id="callf">${v.token}</td>
                                <td>${rec_point}-${drop_point}</td>
                                <td><span class="badge badge-light border border-primary mt-1 text-primary">${status}</span></td>
                                <td>${location}</td>
                                <td  class="text-center"><span class="badge badge-light border border-gray px-2 mt-1 text-primary">${v.parcel_quantity}</span></td>
                                <td>${v.total_charges}</td>
                                <td><a href="#" class="btn btn-sm" onclick="detail_info('${v.token}')"><i class="fas fa-ellipsis-h"></i></a></td>
                              </tr>`;
                }
            });
            $('#det').html(htmlcard);

            $('.progress-track').append(htmlcard1);

            $('#list').html(htmltable);
           }
    });
}

function detail_info(vall){

  // alert(vall);
  $.ajax({
           type:'POST',
           url:'/detail_info',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "tok" : vall
            },

           success:function(data){
                //  alert(data.customer_phone);
                var htmldt = "";

                var htmldt1 = "";
              if(data.customer_date == null && (data.customer_status==3 || data.customer_status == 4)){
                cust_date = "No Date";
              }
              else  if(data.customer_date == null)
              {
                cust_date = "Updated Soon!";
              }
              else
              {
                cust_date = data.customer_date;
              }
              if(data.myawady_date == null)
              {
                myawady_date = "No Date";
              }
              else
              {
                myawady_date = data.myawady_date;
              }
              if(data.dropoff_date == null)
              {
                dropoff_date = "No Date";
              }
              else
              {
                dropoff_date = data.dropoff_date;
              }
              if(data.remark == null)
              {
                  var remark = 'မရှိ';
              }
              else
              {
                  var remark = data.remark;
              }
              if(data.receive_point == 1){
                 var rec_point = 'BKK';
               }
              else if(data.receive_point ==2){
                var rec_point = 'YGN';
              }
              else if(data.receive_point == 3){
                var rec_point = 'MDY';
              }
               else if(data.receive_point == 4){
                var rec_point = 'Maesot';
              }
              if(data.dropoff_point == 1){
                 var drop_point = 'BKK';
               }
              else if(data.dropoff_point ==2){
                var drop_point = 'YGN';
              }
              else if(data.dropoff_point == 3){
                var drop_point = 'MDY';
              }
               else if(data.dropoff_point == 4){
                var drop_point = 'Maesot';
              }
              if(data.receive_status == 0){
                var rec_status = 'Not Received';
              }
              else if(data.receive_status == 1){
                var rec_status = 'Received';
              }
              if(data.myawady_status == 0){
                var mya_status = 'Not started';
              }
              else if(data.myawady_status == 1){
                var mya_status = 'On the Way';
              }
              else if(data.myawady_status == 2){
                var mya_status = 'Arrived';
              }
              if(data.dropoff_status == 0){
                var drop_status = 'Not started';
              }
              else if(data.dropoff_status == 1){
                var drop_status = 'On the Way';
              }
              else if(data.dropoff_status == 2){
                var drop_status = 'Arrived';
              }

              if(data.customer_status == 0){
                var cust_status = 'Not started';
              }
              else if(data.customer_status == 1){
                var cust_status = 'On the Way';
              }
              else if(data.customer_status == 2){
                var cust_status = 'Arrived';
              }
              else if(data.customer_status == 3){
                var cust_status = 'Collect';
              }
              else if(data.customer_status == 4){
                var cust_status = 'Lost';
              }

              if(data.token == null){
                    var token = "-";
                  }else{
                    var token = data.token;
                  }
                  if(data.tracking_no == null){
                    var tracking_no = "-";
                  }else{
                    var tracking_no = data.tracking_no;
                  }
                  if(data.total_weight == null){
                    var total_weight = "-";
                  }else{
                    var total_weight = data.total_weight;
                  }
               
              var addre = data.customer_address;
              var re_addre = addre.split(",").pop();


              $('#ph').hide();

                htmldt += `<div class="card order ">
                        <div class="title">Purchase Reciept</div>
                        <div class="info">
                          <div class="row">
                                <div class="col-4"> <span id="heading">BKK-MAESOT Date</span><br> <span id="details">${data.receive_date}</span> </div>
                                <div class="col-4 pull-right"> <span id="heading">Token No.</span><br> <span id="details">${token}</span> </div>
                                <div class="col-4 pull-right"> <span id="heading">Tracking No.</span><br> <span id="details">${tracking_no}</span> </div>
                            </div>
                        </div>
                        <div class="pricing">
                            <div class="row">
                                <div class="col-9"> <span id="name">Customer Name</span> </div>
                                <div class="col-3"> <span id="price">${data.customer_name}</span> </div>
                            </div>
                            <div class="row">
                                <div class="col-9"> <span id="name">Customer Phone Number</span> </div>
                                <div class="col-3"> <span id="price">${data.customer_phone}</span> </div>
                            </div>
                            <div class="row">
                                <div class="col-9"> <span id="name">Parcel Quantity</span> </div>
                                <div class="col-3"> <span id="price">${data.parcel_quantity}</span> </div>
                            </div>
                            <div class="row">
                                <div class="col-9"> <span id="name">Remark</span> </div>
                                <div class="col-3"> <span id="price">${remark}</span> </div>
                            </div>
                        </div>
                        <div class="total">
                          <div class="row">
                                <div class="col-9"> <span id="name">Total Charges</span> </div>
                                <div class="col-3"> <span id="price">${data.total_charges}</span> </div>
                            </div>

          
                            
                            <div class="row">
                                <div class="col-9"> <span id="name">Total Weight</span> </div>
                                <div class="col-3"> <span id="price">${total_weight}Kg</span> </div>
                              </div>
                        </div>
                        <div class="tracking mt-2">
                            <div class="title">Tracking Order</div>
                        </div>
                        <div class="progress-track">

                        </div>
       
                        <div class="pricing mt-2">
                            <strong id="name">Receive Point</strong>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3"><span class="border border-primary px-1" id="now">${rec_point}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${rec_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${data.receive_date}</span></div>
                            </div>
                        </div>
                        <div class="total mt-2">
                            <strong id="name">Border Point</strong>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3"><span class="border border-primary px-1" id="now">Myawaddy</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${mya_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${myawady_date}</span></div>
                            </div>
                        </div>
                        <div class="pricing">
                            <strong id="name">Dropoff Point</strong>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3"><span class="border border-primary px-1" id="now">${drop_point}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${drop_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${dropoff_date}</span></div>
                            </div>
                        </div>
                        <div class="total">

                            <strong id="name">Customer Point</strong>
                            <div class="row">
                                <div class="col-1"></div>

                                <div class="col-3"><span class="border border-primary px-1" id="now">${re_addre}</span></div>

                                <div class="col-4"><span class="border border-primary px-1" id="now">${cust_status}</span></div>
                                <div class="col-4"><span class="border border-primary px-1" id="now">${cust_date}</span></div>

                            </div>
                        </div>
                        <div class="footer pricing">
                            <div class="row">
                                <div class="col-10" style="font-size:13px;">Want any help? Please &nbsp;<a> contact us</a></div>
                            </div>
                        </div>
                    </div>`;


                    if( data.receive_status == 0 && data.myawady_status != 2 && data.dropoff_status != 2 && data.customer_status !=2){
                    htmldt1 += `

                            <ul id="progressbar">
                                <li class="step0 " id="step1">Thai</li>
                                <li class="step0 text-center" id="step2">Myawady</li>
                                <li class="step0 text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }

                    else if( data.receive_status == 1 && data.myawady_status != 2 && data.dropoff_status != 2 && data.customer_status !=2){
                    htmldt1 += `

                            <ul id="progressbar">
                                <li class="step0 active " id="step1">Thai</li>
                                <li class="step0 text-center" id="step2">Myawady</li>
                                <li class="step0 text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }
                    else if(data.receive_status == 1 && data.myawady_status == 2 && data.dropoff_status != 2 && data.customer_status !=2){
                    htmldt1 += `

                            <ul id="progressbar">
                                <li class="step0  active" id="step1">Thai</li>
                                <li class="step0 active text-center" id="step2">Myawady</li>
                                <li class="step0 text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }
                    else if(data.receive_status == 1 && data.myawady_status == 2 && data.dropoff_status == 2 && data.customer_status !=2){
                    htmldt1 += `

                            <ul id="progressbar">
                                <li class="step0  active" id="step1">Thai</li>
                                <li class="step0 active text-center" id="step2">Myawady</li>
                                <li class="step0 active text-right" id="step3">On the way</li>
                                <li class="step0 text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }
                    else if(data.receive_status == 1 && data.myawady_status == 2 && data.dropoff_status == 2 && data.customer_status ==2){
                    htmldt1 += `

                            <ul id="progressbar">
                                <li class="step0  active" id="step1">Thai</li>
                                <li class="step0 active text-center" id="step2">Myawady</li>
                                <li class="step0 active text-right" id="step3">On the way</li>
                                <li class="step0 active text-right" id="step4">Delivered</li>
                            </ul>
                                  `;
                    }

              $('#det').html(htmldt);
              $('.progress-track').append(htmldt1);
           }

      });


}

// function hide_card(){
//     $('#det').hide();
// }


</script>

@endsection

@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="container">
    {{-- start nav-pill --}}
    <ul class="nav nav-pills">
        <li class=" nav-item"> 
            <a href="#navpills-1" id="n1" class="nav-link active" data-toggle="tab" aria-expanded="false" style="font-size:19px;">Add Way Plan</a> 
        </li>
        <li class="nav-item"> 
            <a href="#navpills-2" id="n2" class="nav-link" data-toggle="tab" aria-expanded="false" style="font-size:19px;" onclick="added({{$way->id}})">Current Added Way Plan Lists</a> 
        </li>
    </ul>

    <div class="tab-content br-n pn">
        <div id="navpills-1" class="tab-pane active">
            
            <div class="card px-2 pt-4">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Route Name</label>
                        <select class="form-control rounded border border-primary" aria-label=".form-select-lg example" name="adv_route" id="adv_route">
                            <option selected hidden>Choose Routes</option>
                            @foreach($package as $pack)
                            <option data-from="{{$pack->from_city_id}}" data-to="{{$pack->to_city_id}}">{{$pack->from_city_name}} - {{$pack->to_city_name}} Route</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mt-4">
                        <button class="btn btn-primary" style="margin-top:5px;margin-left:px" onclick="search_adv()"><i class="fas fa-plus mr-2" style="border-radius: 7px;"></i>Add Route</button>
                    </div>
                    <input type="hidden" name="hide_id" id="hide_id" value="{{$way->id}}">
                    <input type="hidden" name="way_no" id="way_no" value="{{$way->way_no}}">
                    <input type="hidden" name="rider" id="rider" value="{{$way->rider_name}}">
                    <input type="hidden" name="way_date" id="way_date" value="{{$way->date}}">
                    <input type="hidden" name="start" id="start"  value="{{$way->start_time}}">
                    <input type="hidden" name="end" id="end"  value="{{$way->end_time}}">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-2">
                        <label>Start Time</label>
                        <input type="time" class="form-control rounded border border-primary mb-2" name="way_time" id="way_time">
                    </div>
                    <div class="col-md-2">
                        <label>End Time</label>
                        <input type="time" class="form-control rounded border border-primary mb-2" name="end_time" id="end_time" onchange="endtime()">
                    </div>
                    
                </div>
               <div class="mt-2">
                <table class="table table-striped">
                    <thead class="bg-info text-white">
                      <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Receive Date</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Pak Qty</th>
                        <th>Contact Number</th>
                        <th>Weight</th>
                        <th>Total Charges</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody id="search_result">
        
                    </tbody>
                </table>
            </div>
            
              </div>
        </div>
    
        <div id="navpills-2" class="tab-pane">
          <input type="hidden" id="wayplan_id" value="{{$wayplan_id}}">
            <div class="card px-2 pt-4">
                <div class="card-body" id="hello">
                    @foreach ($time_Unique as $time)
                    <h3 class="mt-2">{{$time->route_name}}</h3>
                    <div class="row mt-3">
                      <div class="offset-md-3 col-md-2">
                        <h4>Start Time</h4>
                        <h6>{{$time->start_time}}</h6>
                      </div>
                      <div class="col-md-2">
                        <h4>End Time</h4>
                        <h6>{{$time->end_time}}</h6>
                      </div>
                      <div class="col-md-2">
                        <form action="{{route('more_add_wayplan',$wayplan_id)}}" method="post">
                          @csrf
                          <input type="hidden" name="rout_name" value="{{$time->route_name}}">
                          <input type="hidden" name="start_time" value="{{$time->start_time}}">
                          <input type="hidden" name="end_time" value="{{$time->end_time}}">
                        <button class="btn btn-primary more" style="margin-top:5px;margin-left:px" onclick="more()"><i class="fas fa-plus mr-2" style="border-radius: 7px;"></i>Add Route</button>
                        </form>
                      </div>
                    </div>
                      <table class="table mt-4">
                        <thead  class="thead-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Date</th>
                            <th scope="col">Pak Qty</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Total Charges</th>
                            <th  scope="col" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1;?>
                          @foreach($wayplan as $way)
                          @foreach ($wayplanning as $plan)
                            @if($plan->start_time == $time->start_time && $way->id == $plan->way_plan_schedule_id)
                            <tr>
                              <td>{{$i++}}.</td>
                              <td><i class="far fa-user mr-2" style="size:7px"></i>{{$way->customer_name}}</td>
                              <td>{{$plan->date}}</td>
                              <td>&nbsp;&nbsp;&nbsp;{{$way->parcel_quantity}}</td>
                              <td class="text-center">{{$way->customer_phone}}</td>
                              <td>{{$way->total_weight}}<span class="font-weight-bold">Kg</span></td>
                              <td class="text-center">{{$way->total_charges}}</td>
                              @if ($plan->remark == null)
                              <td>
                                <button class="btn btn-sm btn-warning" id="btn_remark{{$way->id}}"  data-toggle="modal" data-target="#add_remark{{$way->id}}">Remark</button>
                              </td>
                              @else
                              <td>
                                <button class="btn btn-sm" style="background-color:pink;" id="btn_remark{{$way->id}}">Remark</button>
                              </td>
                              @endif
                              <div class="modal fade" id="add_remark{{$way->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                            <input type="hidden" id="way_id" name="way_id" value="">
                                            <div class="form-group">
                                                <label for="">Remark</label>
                                                <input type="text" class="form-control" name="remark_add" id="order_remark{{$way->id}}">
                                            </div>              
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" onclick="save_remark({{$way->id}})">Save</button>
                                    </div>
                                  </div>
                                  </div>
                              </div>
                          </tr>
                            @endif
                          @endforeach
                          {{-- @if($wayplanning->way_plannings[$j++]->start_time == $time->start_time && $wayplanning->way_plannings[$d++]->end_time == $time->end_time) --}}
              
                        {{-- @endif --}}
                        {{-- @endforeach --}}
                        @endforeach
                        </tbody>
                      </table>
                    @endforeach
                  </div>
      
                </div>
        </div>
    </div>
    {{-- end nav-pill --}}

</div>
</div>



@endsection

@section('js')

<script>

    function search_adv()
 {
  // alert('search');
  var from_id = $('#adv_route').find(":selected").data('from');
  var to_id = $('#adv_route').find(":selected").data('to');
  var hide_id = $('#hide_id').val();

  $.ajax({
        type:'POST',
        url:'/wayplanning_search',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "from":from_id,
            "to":to_id,
            "hide_id":hide_id,

        },

        success:function(data){
           
          //  alert('ajax');
            if (!$.trim(data)){  
                // alert("hel");
                var htmlways="";
                htmlways += `<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>မရှိပါ</td>
                </tr>`;
            }
            else
            {
                if(data.time != null){
                $('#way_time').val(data.time.end_time);
                
                 }else{
                    var start = $('#start').val();
                    $('#way_time').val(start);
                 }
            var htmlways="";
            $.each(data.way_plan_list,function(i,v){
                // var url = "{{url('/way_planning')}}/"+v.id;
                if(v.total_weight == null){
                    var total_weight = '-';
                }else{
                    var total_weight = v.total_weight;
                }
                htmlways += `<tr>
                <td>${++i}</td>
                <td>${v.customer_name}</td>
                <td>${v.receive_date}</td>
                <td><span class="badge badge-light border border-danger mt-1  text-danger">Pending</span></td>
                <td>${v.receivelocation.name}</td>
                <td>&nbsp;&nbsp;&nbsp;${v.parcel_quantity}</td>
                <td>${v.customer_phone}</td>
                <td>${total_weight}</td>
                <td>${v.total_charges}</td>
                <td><a href="" class="btn btn-sm btn-primary" data-toggle="modal" onclick="way_remark(${v.id})">Add</a>
                </td>
                </tr>`
                
            });
            }
            $('#search_result').html(htmlways);
        }
      });

// alert(from_id+"---"+to_id+"==="+advance_date);
}

function way_remark(id){
    // alert(id);
    // $('#way_id').val(id);
    save_wayplan(id);
}

function save_wayplan(id){
    // var id= $('#way_id').val();
    // alert(id);
    // var remark = $('#remark_add').val();
    var hide_id = $('#hide_id').val();
    var way_no = $('#way_no').val();
    var rider = $('#rider').val();
    var date = $('#way_date').val();
    var start_time = $('#way_time').val();
    var end_time = $('#end_time').val();
    var from_id = $('#adv_route').find(":selected").data('from');
    var to_id = $('#adv_route').find(":selected").data('to');
  var route = $('#adv_route').find(":selected").text();
    $.ajax({
        type:'POST',
        url:'/way_planning',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "way_id":id,
            "hide_id":hide_id,
            "way_no":way_no,
            // "remark":remark,
            "rider" : rider,
            "date" : date,
            "start_time" : start_time,
            "end_time" : end_time,
            "route" : route,
            "from_id" : from_id,
            "to_id" : to_id,
        },

        success:function(data){
            // alert(data.wayplanlist);
            swal("added!", "Your new way plan has been added.", "success");
            var htmlways="";
            $.each(data.wayplanlist,function(i,v){
                // var url = "{{url('/way_planning')}}/"+v.id;
                if(v.total_weight == null){
                    var total_weight = '-';
                }else{
                    var total_weight = v.total_weight;
                }
                htmlways += `<tr>
                <td>${++i}</td>
                <td>${v.customer_name}</td>
                <td>${v.receive_date}</td>
                <td><span class="badge badge-light border border-danger mt-1  text-danger">Pending</span></td>
                <td>${v.receivelocation.name}</td>
                <td>&nbsp;&nbsp;&nbsp;${v.parcel_quantity}</td>
                <td>${v.customer_phone}</td>
                <td>${total_weight}</td>
                <td>${v.total_charges}</td>
                <td>
                    <a href="" class="btn btn-sm btn-primary" data-toggle="modal" onclick="way_remark(${v.id})">Add</a>
                </td>
                </tr>`;    
            });
            $('#search_result').html(htmlways);

            // $('#hello').hide();
            // $('#hello').show();     
        }
    })
}

function added(id){
    // var id= $('#way_id').val();
    // var remark = $('#remark_add').val();
    var hide_id = $('#hide_id').val();

    $.ajax({
        type:'POST',
        url:'/current_way_planning',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "hide_id":hide_id,
        },

        success:function(data){
            // alert('success')
            var html = '';
            var i=1;var j=0;
                $.each(data.wayplan,function(i,v){
                    if(data.way_plannings[$j++].start_time == b.start_time){
                        html += `
                        <tr>
            <td>${i++}}.</td>
            <td><i class="far fa-user mr-2" style="size:7px"></i>${v.customer_name}</td>
            <td>${data.way_plannings[$j++].date}</td>
            <td>&nbsp;&nbsp;&nbsp;${v.parcel_quantity}</td>
            <td class="text-center">${v.customer_phone}</td>
            <td>${v.total_weight}<span class="font-weight-bold">Kg</span></td>
            <td class="text-center">${v.total_charges}</td>
            
            <td>
              <button class="btn btn-sm btn-info"  data-toggle="modal" data-target="#add_remark${v.id}">Remark</button>
            </td>
            </tr>
                        `;
                    }
                });

            //endtest
            //         var html="";
            // $.each(data.wayplan,function(j,b){
            //     // var url = "{{url('/way_planning')}}/"+v.id;
            //     // alert(b.total_weight);
            //     if(b.total_weight == null){
            //         var total_weight = '-';
            //     }else{
            //         var total_weight = b.total_weight;
            //     }
            //     html += `
            //     <tr>
            //     <td>${++j}</td>
            //     <td>${b.customer_name}</td>
            //     <td>${b.receive_date}</td>
            //     <td><span class="badge badge-light border border-danger mt-1  text-danger">Pending</span></td>
            //     <td>${b.receivelocation.name}</td>
            //     <td>&nbsp;&nbsp;&nbsp;${b.parcel_quantity}</td>
            //     <td>${b.customer_phone}</td>
            //     <td>${total_weight}</td>
            //     <td>${b.total_charges}</td>
            //     <td><a href="" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#add_remark">Remark</a>
            //     </td>
                
            //     `;
            //     // html+=`<td>hello</td>`;    
            // });
            // alert(html);
            var html1 = '';
            html1 +=   `<h4>testing</h4>`;
            $('#add_way').html(html);
            //  }
            // $('#current_added_way').html(html);
             
        }
    })
}
function save_remark(id){
  // alert(id);
  var hide_id = $('#wayplan_id').val();
  alert(hide_id);
  var remark = $('#order_remark'+id).val();
  alert(remark);
  $.ajax({
        type:'POST',
        url:'/save_remark',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "id":id,
            "remark":remark,
            "hide_id":hide_id,
        },

        success:function(data){
          swal("Stored!", "Remark has been stored  for this way.", "success");
          // $('#remark_add').val('');
          $('#add_remark'+id).modal('hide');
          $('#btn_remark'+id).css('background-color','pink');
        }
      });
}
function endtime(){
    var end_time = $('#end_time').val();
    var end = $('#end').val();
    var start = $('#way_time').val();
    var endd = (end_time).split(":");
    var startt = (start).split(":");
    var time1 = startt[1];
    var time2 = endd[1];
    var duration1 = time2 - time1;
    var time3 = startt[0];
    var time4 = endd[0];
    if(time3 != 00 && time3 != 00){
        var duration2 = time4 - time3;
    }
    else if(time3 == 0){
        time3 = 12;
        var duration2 = time4 - time3;
    }
    else if(time4 == 0){
        time4 = 12;
        var duration2 = time4 - time3;
    }
    if(duration1 < 0 &&  duration2 == 1){
        swal("Warning!", "Your start time and end time duration must have at least one hour.", "warning");
    }
    if(end_time > end){
        swal("Wrong!", "Your end time is over this way's end time.", "error");
    }
    
}
function more(){
  $('.more').submit();
}
</script>

@endsection
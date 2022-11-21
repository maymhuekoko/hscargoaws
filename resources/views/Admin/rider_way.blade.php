@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="container">
    <form>
        @csrf
        <div class="row">
        
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" class="form-control" id="rider_date">
                </div>
            </div>
            <div class="col-md-3">
                    <button type="button" class="btn btn-info mt-4" onclick="rider_way()">Search</a>
            </div>
        </div>
        
    </form>
    
    <div class="card">
        <table class="table table-striped mt-2">
            <thead class="bg-info text-white">
                <tr>
                  <th>No</th>
                  <th>Customer</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Location</th>
                  <th>Pak Qty</th>
                  <th>Contact Number</th>
                  <th>Weight</th>
                  <th>Total Charges</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="rider_ways">
                <div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="complete_id">
                                <div class="form-group">
                                    <label for="">Arrived Date</label>
                                    <input type="date" class="form-control" name="arr_date" id="arr_date">
                                </div>
                                <div class="form-group">
                                    <label for="">Arrived Time</label>
                                    <input type="time" class="form-control" name="arr_time" id="arr_time">
                                </div>              
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="complete()">Complete</button>
                        </div>
                        </div>
                        </div>
                    </div>
              </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')

<script>
    function rider_way()
 {
  var date = $('#rider_date').val();

  $.ajax({
        type:'POST',
        url:'/search_rider_way',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "date":date,
        },

        success:function(data){
          
            if (!$.trim(data.wayplanning)){  
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
                var m=1;
                var t=0;
                var tt=0;
                var nn = 0;
            $.each(data.wayplanning,function(i,v){
                // alert(v.id);
                // $.each(v.way_plannings,function(j,b){
                // alert(b.id);
                $.each(data.schedule,function(k,a){
                    // alert(a.way_planning_id);
                    if(v.id == a.way_planning_id){
                        if(a.total_weight == null){
                            var total_weight = '-';
                        }else{
                            var total_weight = a.total_weight;
                        }
                        var customer = a.customer_name;
                        htmlways += `<tr>
                            <td>${m++}</td>
                            <td>${customer}</td>
                            <td>${v.way_plannings[t++].start_time}</td>
                            <td>${v.way_plannings[tt++].end_time}</td>
                            <td>${a.receivelocation.name}</td>
                            <<td>&nbsp;&nbsp;&nbsp;${a.parcel_quantity}</td>
                            <td>${a.customer_phone}</td>
                            <td>${total_weight}-kg</td>
                            <td>${a.total_charges}</td>`;
                        $.each(data.complete,function(y,z){
                            if(a.id == z.way_plan_schedule_id){ 
                            if(z.arrive_date == null){
                            htmlways += `
                            <td><a href="../complete_page/${a.id}" class="btn btn-sm btn-primary">Complete</a>
                            </td>
                            </tr>
                            `;
                        }else{
                            htmlways += `
                            <td><button class="btn btn-sm btn-success">Complete</button>
                            </td>
                            </tr>
                            `;
                        }
                    }
                        });  
                    }
                });   
            // });
            });
            
            }
            $('#rider_ways').html(htmlways);
        }
      });

// alert(from_id+"---"+to_id+"==="+advance_date);
}
function complete_id(id){
    $('#complete_id').val(id);
    // $('#complete_page').submit();
}

function complete(){
    var id = $('#complete_id').val();
    var arr_date = $('#arr_date').val();
    var arr_time = $('#arr_time').val();
    $.ajax({
        type:'POST',
        url:'/complete_way',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "id":id,
            "arr_date" : arr_date,
            "arr_time" : arr_time
        },

        success:function(data){
            alert('success');
            $('#complete').modal('hide');
        }
    })
}
</script>

@endsection
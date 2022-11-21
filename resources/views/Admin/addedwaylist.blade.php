@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="">
     <input type="hidden" id="wayplan_id" value="{{$wayplan_id}}">
     <div class="card px-2">
    <div class="card-body">
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

@endsection

@section('js')

<script>
function save_remark(id){
  alert(id);
  var hide_id = $('#wayplan_id').val();
  // alert(hide_id);
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
function more(){
  $('.more').submit();
}
</script>

@endsection
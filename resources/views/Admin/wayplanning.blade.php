@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class='container' width="100%">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3 class="text-info">Way Lists</h3>
        </div>
        <div class="col-md-6">
            <a href="" class="btn bg-primary text-white float-right" data-toggle="modal" data-target="#create_contact"><i class="fas fa-plus mr-2" style="border-radius: 7px;"></i>Add New Way</a>
            <div class="modal  fade" id="create_contact" role="dialog" aria-hidden="true" class="hhh">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:rgb(165, 25, 153)">Way Create Form</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
    
                        <div class="modal-body">
    
                            <form method="POST" action="{{route('store_way')}}" enctype='multipart/form-data'>
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                    <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Way No</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="way_no" class="form-control border border-outline border-primary" placeholder="Enter Way No,">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                    <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Date</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="date" name="date" class="form-control border border-outline border-primary">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                    <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Start Time</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="time" name="start_time" class="form-control border border-outline border-primary" placeholder="Enter Start Time,">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                    <label for="" style="color:rgb(34, 190, 241)" class="mt-3">End Time</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="time" name="end_time" class="form-control border border-outline border-primary" placeholder="Enter End Time,">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                    <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Rider Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="rider_name" id="rider_name" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" class="border border-outline border-primary">
                                                <option selected hidden>Choose Rider Name</option>
                                                @foreach($riders as $rider)
                                                <option value="{{$rider->id}}">{{$rider->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row offset-3 mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Save</button></a>
                                    <button class="btn btn-lg btn-danger ml-3" data-dismiss="modal">Cancel</button>
                               </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-striped text-black">
                <thead class="bg-info text-white">
                  <tr style="font-size: 18px">
                    <th>#</th>
                    <th>Way No</th>
                    <th>Date</th>
                    <th>Rider Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php $i=1; ?>
                @foreach($ways_list as $list)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$list->way_no}}</td>
                    <td>{{$list->date}}</td>
                    <td>{{$list->rider_name}}</td>
                    <td>{{$list->start_time}}</td>
                    <td>{{$list->end_time}}</td>
                    <td class="text-center">
                        <a href="{{route('add_wayplan',$list->id)}}" class="btn btn-warning"><i class="far fa-plus mr-2"></i>Add Way Plan</a>
                        <a href="{{route('show_added_wayplan',$list->id)}}" class="btn btn-success"><i class="far fa-plus mr-2"></i>Show Added Way</a>
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>

</script>
@endsection
@extends('master')
@section('title', 'Dashboard')
@section('content')


    <div class="card" style="width: 45rem;">
        <h3 class="text-center mt-3">Complete Way Registration</h3>
        <div class="card-body">
            <form action="{{route('complete_way')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="way_id" id="way_id" value="{{$way_id}}">
            <div class="form-group">
                <label for="">Arrived Date</label>
                <input type="date" class="form-control" name="arr_date" id="arr_date">
            </div>
            <div class="form-group">
                <label for="">Arrived Time</label>
                <input type="time" class="form-control" name="arr_time" id="arr_time">
            </div> 
            <div class="col-md-12">
                <label class="" for="">Draw Signature:</label>
                <br/>
                <div id="sig"></div>
                <br><br>
                <button id="clear" class="btn btn-danger">Clear Signature</button>
                <textarea id="signature" name="signed" style="display: none"></textarea>
            </div>
            <div class="form-group mt-3">
                <label for="photo">Take or select photo(s)</label><br />
                <input type="file" name="photo" id="photo" accept="gallery/*" capture="camera"/>
            </div> 
            <div class="row">
                <a href="{{route('rider_way')}}" class="offset-md-5 btn btn-secondary">Back</a>
                {{-- <a href="" class="btn btn-submit btn-primary">Complete</a> --}}
                <button type="submit" class="btn btn-info ml-2">Complete</button>
            </div>
            </form>
        </div>  
    </div>           


@endsection

@section('js')

<script type="text/javascript">
      var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature").val('');
    });
    
</script>

@endsection
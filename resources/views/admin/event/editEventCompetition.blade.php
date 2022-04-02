@extends('layouts.admin')

@section('content')
<style>
    .dlk-radio input[type="radio"],
.dlk-radio input[type="checkbox"] 
{
    display:none;
}
.dlk-radio input[type="radio"] + .fa ,
.dlk-radio input[type="checkbox"] + .fa {
     opacity:0.15
}
.dlk-radio input[type="radio"]:checked + .fa,
.dlk-radio input[type="checkbox"]:checked + .fa{
    opacity:1
}
a.disabled {
  pointer-events: none;
  cursor: default;
}
</style>
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
          <div class="content-header">

          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
               <div class="col-12">

                  <div class="row mb-2">
                    <div class="col-sm-2">
                        <a href="/admin/eventTickets/{{$eventId}}" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
                  </div>

              </div>
          </div>
          <div class="row">

              <div class="col-md-2">
              </div>
              <div class="col-md-8">
                <form method="post" action="{{ url('admin/UpdateCompetition') }}" enctype="multipart/form-data" id="regForm">

                  {{ csrf_field() }}
                  <div class="card">
                     @if(Session::has('success'))
                     <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <input type="hidden" name="competition_id" value="{{$id}}">
                    <input type="hidden" name="eventId" value="{{$eventId}}">
                    <div class="card-header"><center><strong>Edit Competition</strong></center></div>
                    <div class="card-body">
                        <div class="row">
                         <div class="col-md-6 form-group">
                            <label for="Description">Member Fees :&nbsp;<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="member_fee" name="member_fee" value="{{$EventCompetition['member_fee']}}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="Description">Non Member Fees :&nbsp;<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="non_member_fee" name="non_member_fee" value="{{$EventCompetition['non_member_fee']}}"required>
                        </div>
                        <div class="col-md-6">
                            <div class="well well-sm ">
    <div class="dlk-radio">
       @foreach($Locations as  $location)
        <label>
            <input name="location[]" class="form-control" type="checkbox" value="{{$location->id}}">
            <i class="fa fa-check glyphicon glyphicon-ok"></i>
            {{$location->location_name}}
       </label><br>
       @endforeach
       @foreach($AddedLocations as  $AddedLocation)
        <label>
            <input name="location[]" class="form-control" type="checkbox" value="{{$AddedLocation->id}}" checked="">
            <i class="fa fa-check glyphicon glyphicon-ok"></i>
            {{$AddedLocation->location_name}}
       </label><br>
       @endforeach
       </div>
</div>
                        </div>
                    </div>
<div style="overflow:auto;">
    <center >
      <button type="submit" class="button nextBtn" id="nextBtn" >Update</button>
    </center>
  </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

@endsection
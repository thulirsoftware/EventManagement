@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="add-button" >
                    <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/addEvent') }}">Add Events</a> 
                </div><br><br>
                <div class="card">
                   @if(Session::has('success'))
                   <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{Session::get('success')}}
                  </div>
                  @endif
                <div class="card-body">
                <table class="table table-bordered table-striped" id="event_list">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Event Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Venue</th>

                      <th >Action</th>
                  </tr>
              </thead>
              <tbody> 
                  <?php $i=1 ?> 
                  @foreach($events as $event)
                  <?php
                  $string = str_replace(" ","\r\n",$event['eventName']);
                  ;
                  $newtext = wordwrap($event['eventName'], 20, "\n");
                  $EventRegistration = \App\EventRegistration::where('event_id',$event->id)->count();
              ?>
              <tr>

                  <td>{{ $i++ }}</td>
                  <td>{!! nl2br(e($newtext)) !!}</td>
                  <td>{{ $event['eventDate'] }}</td>
                  <td>{{ $event['eventTime'] }}</td>
                  <td>{{ $event['eventLocation'] }}</td>
                  <td>
                   
                    <a href="/admin/eventTickets/{{ $event['id'] }}" class="btn btn-success btn-sm"><i class="fa fa-eye" style="text-align:center;"></i></a>&nbsp;&nbsp; 
                    @if($EventRegistration==0)
                    <a onclick="myFunction({{$event['id']}})"  class="btn btn-warning btn-sm"> <i class="fa fa-trash" style="text-align:center;"></i></a>
                    @endif

                    &nbsp;&nbsp;<a href="/admin/createDuplicateEvent/{{ $event['id'] }}" class="btn btn-info btn-sm"><i class="fa fa-clone" style="text-align:center;"></i></a>
                    
                  </td></td>
                 




              </tr>
              @endforeach
          </tbody> 
      </table>
</div>
</div>
  </div>
</div>
</div>

</section>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
//redirect to specific tab
$(document).ready(function () {
  localStorage.clear();
  
});
</script>
<script>
    function myFunction(id) {
     if (confirm("Are you Sure you want to delete the event?")) {
        $.ajax({
            type : 'get',
            url : '{{URL::to('admin/eventDelete')}}',
            data : {'id':id},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {

    }
}


</script>
@endsection

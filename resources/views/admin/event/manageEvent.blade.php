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
              @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
                <table class="table table-condensed" style="background-color:white;box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Event Name</th>
                      <th>Description</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Location</th>
                      <th>E.Tickets</th>
                      <th>F.Tickets</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody> 
              <?php $i=1 ?> 
                      @foreach($events as $event)
                      <?php
                       $string = str_replace(" ","\r\n",$event['eventName']);
                       ;
                        $newtext = wordwrap($event['eventName'], 20, "\n");
                        $eventDescription = wordwrap($event['eventDescription'], 20, "\n");
                      ?>
                        <tr>
                         
                          <td>{{ $i++ }}</td>
                          <td>{!! nl2br(e($newtext)) !!}</td>
                          <td>{!! nl2br(e($eventDescription)) !!}</td>
                          <td>{{ $event['eventDate'] }}</td>
                          <td>{{ $event['eventTime'] }}</td>
                          <td>{{ $event['eventLocation'] }}</td>
                          
                          <td><a href="/admin/editEventEntryTicket/{{ $event['id'] }}" ><i class="fa fa-eye fa-lg" style="text-align:center;"></i></a></td>

                          <td><a href="/admin/editEventTicket/{{ $event['id'] }}" ><i class="fa fa-eye fa-lg" style="text-align:center;"></i></a></td>
                          <td><a href="/admin/eventEdit/{{ $event['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:center;"></i></a></td>
                          <td><a onclick="myFunction({{$event['id']}})" style="text-align:center;color: #0069d9;cursor:pointer"
                            ><i class="fa fa-trash fa-lg" style="text-align:center;"></i></a></td>
                          

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
             
        </div>
    </div>
</div>

</section>
</div>
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

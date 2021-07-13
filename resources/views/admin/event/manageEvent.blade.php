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
                <table class="table table-condensed" style="background-color:white;box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2)">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Event Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Venue</th>
                   
                      <th colspan="2" style="text-align:center">Action</th>
                    </tr>
                  </thead>
                  <tbody> 
              <?php $i=1 ?> 
                      @foreach($events as $event)
                      <?php
                       $string = str_replace(" ","\r\n",$event['eventName']);
                       ;
                        $newtext = wordwrap($event['eventName'], 20, "\n");
                      ?>
                        <tr>
                         
                          <td>{{ $i++ }}</td>
                          <td>{!! nl2br(e($newtext)) !!}</td>
                          <td>{{ $event['eventDate'] }}</td>
                          <td>{{ $event['eventTime'] }}</td>
                          <td>{{ $event['eventLocation'] }}</td>
                          <td><a href="/admin/eventTickets/{{ $event['id'] }}" class="btn btn-success btn-sm"><i class="fa fa-eye" style="text-align:center;"></i>&nbsp;</a></td>
                          <td><a onclick="myFunction({{$event['id']}})"  class="btn btn-warning btn-sm"> <i class="fa fa-trash" style="text-align:center;"></i></a></td>
                        
                         
                          

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

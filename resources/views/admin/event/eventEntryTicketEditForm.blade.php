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
     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/admin/manageEvent" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        
      </div>
    </div>
    <div class="row">
       <div class="col-md-1">
      </div>
       <div class="col-md-10">
<div class="card">
<div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th>SI.No</th>
        <th>Event Id</th>
        <th>Event Name</th>
        <th>Age Group</th>
        <th>Member Type</th>
        <th>Ticket Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody >
    <?php $i = 1 ?>  
        @foreach($eventTicket as $ticket)
          <tr>
           
            <td>{{ $i++ }}</td>
            <td>{{ $ticket['eventId'] }}</td>
            <?php
              $event = \App\Event::where('id',$ticket['eventId'])->first();
            ?>
            <td>{{ $event['eventName'] }}</td>
            <td>{{ $ticket['ageGroup'] }}</td>
            <td>{{ $ticket['memberType'] }}</td>
            <td>${{ $ticket['ticketPrice'] }}</td>
            <td><a href="/admin/eventTicketDelete/{{ $ticket['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

          </tr>
        @endforeach
    </tbody>
  </table>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
</div>
</section>
</div>


{{-- 
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 --}}


<script type="text/javascript">
  $(document).ready(function () {

  $("#price").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

});
</script>

@if(Auth::user()->job_title=='Admin')
<script language="javascript">
$(document).ready(function()
{ 
       $(document).bind("contextmenu",function(e){
              return false;
       }); 
})
</script>
@endif
@endsection
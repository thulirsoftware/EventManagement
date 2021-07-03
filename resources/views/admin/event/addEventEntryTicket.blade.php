@extends('layouts.admin')

@section('content')
<div class="container" style="padding-top:15px">
    <div class="row">
        <div class="col-md-11 col-md-offset-2">
            <div class="card">
               @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
              <div class="card-header"><center><strong>Add Event Entry Ticket</strong></center></div>
              <div class="card-body">

 
</div>
<div class="panel-body">
  <table class="table">
    <thead>
      <tr>
        <th>SI.No</th>
        <th>Event Id</th>
        <th>Event Name</th>
        <th>Age Group</th>
        <th>Member Type</th>
        <th>Ticket Price</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
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
            <td>{{ $ticket['ticketPrice'] }}</td>
            <td><a href="/admin/eventEntryTicketDelete/{{ $ticket['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

          </tr>
        @endforeach
    </tbody>
  </table>
</div>

</div>
</form>
</div>
</div>
</div>
</div>
</div>





<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

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
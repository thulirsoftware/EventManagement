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
              <div class="card-header"><center><strong>Add Event Ticket</strong></center></div>
              <div class="card-body">

  <form method="post" action="{{ url('admin/addEventTicket') }}">
        {{ csrf_field() }}

        <input type="hidden" name="eventId" value={{ $eventId['id'] }}>

        <div class="col-md-12">
          <div class="row">
        <div class="form-group col-md-6">
          <label class="names">Event</label>
            <input type="text" class="form-control"  name="eventName" value="{{ $eventId['eventName'] }}" required="">
        </div>


        <div class="col-md-6 form-group ">
          <label class="names">Age Group</label>
          <select class="form-control" name="ageGroup" id="sel1">
            <option value="">Select</option>
            <option value="kids">Kids</option>
            <option value="Adult">Adult</option>
          </select>
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Member</label>
          <select class="form-control" name="memberType" id="sel1">
            <option value="">Select</option>
            <option value="member">Member</option>
          </select>
        </div>
        <div class="col-md-6 form-group ">
          <label class="names">Food</label>
          <select class="form-control" name="foodType" id="sel1">
            <option value="">Select</option>
            <option value="veg">Veg</option>
            <option value="nveg">Non-VEg</option>
            <option value="no-food">No Food</option>
          </select>
        </div>
        <div class="col-md-6 form-group ">
          <label class="names">Date</label>
          <input class="form-control" type="date" name="dateRange" id="sel1" >
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Price</label>
          <input class="form-control" type="text" name="ticketPrice" id="sel1" >
        </div>
      </div>
        
        
        
    </div>

    

    <div class="col-md-offset-0 col-md-12 bottom" style="margin-top: 40px" >
        <center><input type="submit" class="btn btn-primary" name="Submit"></center>
    </div>  
</div>
</form>

<div class="panel-body">
  <table class="table">
    <thead>
      <tr>
        <th>SI.No</th>
        <th>Event Id</th>
        <th>Event Name</th>
        <th>Age Group</th>
        <th>Member Type</th>
        <th>Food Type</th>
        <th>Date Range</th>
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
            <td>{{ $ticket['eventName'] }}</td>
            <td>{{ $ticket['ageGroup'] }}</td>
            <td>{{ $ticket['memberType'] }}</td>
            <td>{{ $ticket['foodType'] }}</td>
            <td>{{ $ticket['dateRange'] }}</td>
            <td>{{ $ticket['ticketPrice'] }}</td>
            <td><a href="/admin/eventTicketDelete/{{ $ticket['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

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
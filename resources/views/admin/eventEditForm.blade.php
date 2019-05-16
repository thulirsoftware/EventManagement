@extends('layouts.admin')

@section('content')

<style type="text/css">
    div{
        margin-top:15px;
    }
    .top{
        font-size: 25px;
        font-weight: bold;
        color:brown;
        margin-top: 30px;
    }
    .top1{
        font-size: 30px;
        font-weight: bold;
        color:grey;
        margin-top: 30px;
    }
    .forgot{
    	color:blue;
    	font-size: 15px;
    }
    .names{
    	font-size: 20px;
        font-weight: bold;
        color:brown;
    }
    .bottom{
        font-size: 20px;
        font-weight: bold;
        color:black;
        margin-bottom: 30px;
    }
    .next{
    	background-color: #ff6100;
    	color:black;
    	padding:7px;
    	border-radius: 5px;
    }
</style>
<div class=" col-md-offset-4 col-md-6" style="background-color: #f2edb5;margin-bottom:50px">
  <center><p class="top">Add Event</p></center>
  <form method="post" action="{{ url('admin/eventUpdate') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

  <input type="hidden" name="id" value="{{ $event['id'] }}">

    <div class="col-md-10">
      	
        <div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-6 names">Event Name</span>
          	<input type="text" class="col-md-6"  name="eventName" value="{{ $event['eventName'] }}" required="">
      	</div>


      	<div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-6 names">Event Description</span>
          	<textarea class="col-md-6" rows="5" name="eventDescription" id="comment" value="{{ $event['eventDescription'] }}" required="">{{ $event['eventDescription'] }}</textarea>
      	</div>

      	<div class="input-group col-md-offset-2 col-md-12">
      	 	  <span class="col-md-6 names">Event Picture</span>
			  <div class="custom-file col-md-6">
			    <input type="file" class="custom-file-input" name="eventFlyer">
			  </div>
   		  </div>


   		  <div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-6 names">Venue</span>
          	<input class="col-md-6" type="text" name="eventLocation" value="{{ $event['eventLocation'] }}" required="">
      	</div>

        <div class="input-group col-md-offset-2 col-md-12">
          <span class="col-md-6 names">Location Link</span>
            <input class="col-md-6" type="text" name="eventLocationLink" value="{{ $event['eventLocationLink'] }}">
        </div>

      	<div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-6 names">Date</span>
          	<input class="col-md-6" type="date" id='date' name="eventDate" value="{{ $event['eventDate'] }}" required="">
      	</div>
      	<div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-6 names">Time</span>
          	<input class="col-md-6" type="time" name="eventTime" value="{{ $event['eventTime'] }}">
      	</div>

      <div class="col-md-offset-2 col-md-12 bottom" >
          <center><a href="/admin/addEventTicket"><button type="submit"  class="next btn btn-default btn-lg" name="submit">Submit</button></a></center>
      </div>

</div>
</form>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@endsection
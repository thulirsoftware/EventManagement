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
        font-size: 20px;
        font-weight: bold;
        color:grey;
        margin-top: 30px;
    }
    .forgot{
    	color:blue;
    	font-size: 15px;
    }
    .names{
    	font-size: 17px;
        font-weight: bold;
        color:brown;
    }
    .bottom{
        font-size: 15px;
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
  <form method="post" action="{{ url('admin/addEvent') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="col-md-10">
      	
        <div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-4 names">Event Name</span>
          	<input type="text" class="col-md-6"  name="eventName" required="">
      	</div>


      	<div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-4 names">Event Description</span>
          	<textarea class="col-md-6" rows="5" name="eventDescription" id="comment" required=""></textarea>
      	</div>

      	<div class="input-group col-md-offset-2 col-md-12">
      	 	  <span class="col-md-4 names">Event Picture</span>
			  <div class="custom-file col-md-6">
			    <input type="file" class="custom-file-input" name="eventFlyer">
			  </div>
   		  </div>


   		  <div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-4 names">Venue</span>
          	<input class="col-md-6" type="text" name="eventLocation" required="">
      	</div>

        <div class="input-group col-md-offset-2 col-md-12">
          <span class="col-md-4 names">Location Link</span>
            <input class="col-md-6" type="text" name="eventLocationLink">
        </div>

      	<div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-4 names">Date</span>
          	<input class="col-md-6" type="date" id='date' name="eventDate" required="">
      	</div>
      	<div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-4 names">Time</span>
          	<input class="col-md-6" type="time" name="eventTime">
      	</div>

      <div class="col-md-offset-2 col-md-12 bottom" >
          <center><a href="/admin/addEventTicket"><button type="submit"  class="next btn btn-default btn-lg" name="submit">Submit</button></a>
          <a class="next btn btn-default btn-lg" href="{{ url('admin/manageEvent') }}">Cancel</a></center>
      </div>

</div>
</form>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src=Add Member"//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@endsection
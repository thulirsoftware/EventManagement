@extends('layouts.user')

@section('content')
<div class="content-wrapper" style="background-color:white">
  <!-- Content Header (Page header) -->
 
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">    
  	<div class="row">
  		  <div class="col-md-1">
  		  </div>
        <div class="col-md-10">
                               

		<?php 
		    $noOfEvents = count($events);
		?>

		 @if(Session::has('success'))
		<div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		{{Session::get('success')}}
		</div>
		@endif
		@if($events->count()<=0)
   <div class="alert alert-warning">No New Events</div>
@else
    	@foreach($events as $event)
					<?php
                       $string = str_replace(" ","\r\n",$event['eventName']);
                       ;
                        $newtext = wordwrap($event['eventName'], 20, "\n");
                        $eventDescription = wordwrap($event['eventDescription'], 20, "\n");
                      ?>
		<div class="card card-info" style="-webkit-box-shadow: none;
		-moz-box-shadow: none;	box-shadow: none;background-color: #f7f7f7;height: 220px;border: 1px solid rgba(0,0,0.1,0.1);">
				<div class="card-header" style="background-color: #f5f5fc;color:black">
				     <h3 class="card-title"  style="color: black;">{!! nl2br(e($newtext)) !!}</h3>
				</div>
			  <div class="card-body" style="background-color: white;">
				<p>Date & Time:&nbsp;{{ $event['eventDate'] }} &nbsp;{{ $event['eventTime'] }}<a href="/memberBuyTicket/{{ $event['id'] }}" class="btn btn-primary" style="float:right;margin-right: 40%;">Register</a></p>
				<p>Location:&nbsp;{{ $event['eventLocation'] }}</p>
			 
			</div>
		</div>
		@endforeach
	</div>
@endif
	
	</div>
</div>
</section>
</div>
@endsection
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
     localStorage.removeItem('Competition_value');
   
});
</script>
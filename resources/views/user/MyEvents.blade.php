@extends('layouts.user')

@section('content')
<style>
    .wrap {
  height: 20px;
  position: relative;
  margin: 5px;
}
h2.centre-line {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 80%;
  transform: translate(-50%, -50%);
}
h2.centre-line:before {
  content: "";
  position: absolute;
  width: 100%;
  height: 1px;
  top: 50%;
  left: 0;
  z-index: -1;
  border-style: dotted;
border-width: 1px;
}
h2.centre-line span {
  background-color: white;
  padding: .5rem;
  display: inline-block;
  
}
</style>
<div class="content-wrapper" style="background-color:white">
  <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">  
   <div class="wrap">

  <h2 class="centre-line"><span>Current Events</span></h2>

</div>
            <br>
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
   <div class="alert alert-warning">No New Registered Events</div>
@else
    	@foreach($events as $event)

					<?php
                       $string = str_replace(" ","\r\n",$event['eventName']);
                       ;
                        $newtext = wordwrap($event['eventName'], 20, "\n");
                        $eventDescription = wordwrap($event['eventDescription'], 20, "\n");
                      ?>
                      <button class="accordion">{!! nl2br(e($newtext)) !!}</button>
<div class="panel"  style="background-color:white;border: 1px solid rgba(0,0,0.1,0.1);">
  <div class="panel-body"  style="padding-top:22px;background-color:white">
				<p>Date & Time:&nbsp;{{ $event['eventDate'] }} &nbsp;{{ $event['eventTime'] }} <a href="/memberBuyTicket/{{ $event['id'] }}" class="btn btn-primary" style="float:right;margin-right: 10%;">Add Ticket</a><a href="/ViewEvent/{{ $event['id'] }}" class="btn btn-primary" style="float:right;margin-right: 10%;">View</a></p>
				<p>Location:&nbsp;{{ $event['eventLocation'] }}</p>
			 
			</div>
</div><br>
	
		@endforeach
	</div>
@endif
	
	</div>
	
                	   <div class="wrap">

  <h2 class="centre-line"><span>Past Events</span></h2>

</div>
            <br>
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
		@if($pastevents->count()<=0)
   <div class="alert alert-warning">No New Registered Past Events</div>
@else
    	@foreach($pastevents as $pastevent)

					<?php
                       $string = str_replace(" ","\r\n",$pastevent['eventName']);
                       ;
                        $newtext = wordwrap($pastevent['eventName'], 20, "\n");
                        $eventDescription = wordwrap($pastevent['eventDescription'], 20, "\n");
                      ?>
                      <button class="accordion">{!! nl2br(e($newtext)) !!}</button>
<div class="panel"  style="background-color:white;border: 1px solid rgba(0,0,0.1,0.1);">
  <div class="panel-body"  style="padding-top:22px;background-color:white">
				<p>Date & Time:&nbsp;{{ $pastevent['eventDate'] }} &nbsp;{{ $pastevent['eventTime'] }}</p>
				<p>Location:&nbsp;{{ $pastevent['eventLocation'] }}</p>
			 
			</div>
</div><br>
	
		@endforeach
	</div>
@endif
	
	</div>
</div>
</section>
</div>
@endsection
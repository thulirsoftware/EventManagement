@extends('layouts.user')

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
            
           
                    

<?php 
    $noOfEvents = count($events);
?>

 @if(Session::has('success'))
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
	<div class="card panel-default">

                <div class="card-body">
	<table  class="table">
		<thead >
       		<th>Event Name</th>
	      	<th>Event Description</th>
	      	<th>Event Date</th>
	      	<th>Event Time </th>
	      	<th>Event Location</th>
	      	<th>Action</th>
     	</thead>
     <tbody>

	@for($i=0; $i<$noOfEvents; $i++)
	@if($events[$i]['memberTicketsCount']>0 || $events[$i]['memberEntryTicketsCount']>0 )
	<?php
                       $string = str_replace(" ","\r\n",$events[$i]['eventName']);
                       ;
                        $newtext = wordwrap($events[$i]['eventName'], 20, "\n");
                        $eventDescription = wordwrap($events[$i]['eventDescription'], 20, "\n");
                      ?>
		<tr>
			<td>{!! nl2br(e($newtext)) !!}</td>
                          <td>{!! nl2br(e($eventDescription)) !!}</td>
			<td>{{ $events[$i]['eventDate'] }}</td>
			<td>{{ $events[$i]['eventTime'] }}</td>
			<td>{{ $events[$i]['eventLocation'] }}</td>
			<td><a href="/memberBuyTicket/{{ $events[$i]['id'] }}" class="btn btn-primary" >Buy Ticket</span></a></td>

		</tr>
	   @endif
	              	   
	@endfor
</tbody>
</table>
 
</div>
</div>
</div>
</div>
</div>

@endsection
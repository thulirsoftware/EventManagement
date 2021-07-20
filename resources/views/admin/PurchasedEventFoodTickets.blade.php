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
					<div class="card">
						
						<div class="card-body">
							<table class="table table-bordered table-striped" id="food_report_list">
								<thead>
									<th>S.No</th>
									<th>Event Name</th>
									<th>User Name</th>
									<th>Age Group</th>
									<th>Food Type</th>
									<th>Qty</th>
									<th>Ticket Amount</th>
								</thead>
								<tbody>

									<?php $i=1; 

								?>

								@foreach($PurchasedEventFoodTickets as $member)
								<?php
								$user =  App\User::where('id',$member->userId)->first();
								$event  = App\Event::where('id',$member->eventId)->first();
								$EventTicket  = App\EventTicket::where('id',$member->ticketId)->first();
							?>
							<tr>
								<td> {{ $i++ }} </td>

								<td>{{ $event['eventName'] }}</td>
								<td>{{ $EventTicket['ageGroup'] }}</td>
								<td>{{ $EventTicket['foodType'] }}</td>
								<td>{{ $user['name'] }}</td>
								<td>{{ $member['ticketQty'] }}</td>
								<td>${{ $member['ticketAmount'] }}</td>
								
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
</div>

@endsection
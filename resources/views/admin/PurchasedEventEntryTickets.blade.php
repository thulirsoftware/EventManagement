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
							<table class="table table-bordered table-striped" id="food_entry_list">
								<thead>
									<th>S.No</th>
									<th>Event Name</th>
									<th>Event Date</th>
									<th>User Name</th>
									<th>Age Group</th>
									<th>Qty</th>
									<th>Ticket Amount</th>
								</thead>
								<tbody>

									<?php $i=1; 

								?>

								@foreach($PurchasedEventEntryTickets as $PurchasedEventEntryTickets)
								<?php
								$user =  App\User::where('id',$PurchasedEventEntryTickets->userId)->first();
								$event  = App\Event::where('id',$PurchasedEventEntryTickets->eventId)->first();
								$EventTicket  = App\EventEntryTickets::where('id',$PurchasedEventEntryTickets->ticketId)->first();

								 if($PurchasedEventEntryTickets[$i]['min_age']>=9 && $member[$i]['PurchasedEventEntryTickets']>=16)
					            {
					              $ageGroup = "Adult";
					            }
					            else 
					            {
					              $ageGroup = "Kids";
					            }
							?>
							<tr>
								<td> {{ $i++ }} </td>

								<td>{{ $event['eventName'] }}</td>
								<td>{{ $event['eventDate'] }}</td>
								<td>{{ $user['name'] }}</td>
								<td>{{ $ageGroup }}</td>
								<td>{{ $PurchasedEventEntryTickets['ticketQty'] }}</td>
								<td>${{ $PurchasedEventEntryTickets['ticketAmount'] }}</td>


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
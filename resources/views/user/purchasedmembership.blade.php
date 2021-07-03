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
               
         
                  @if(Request::path() === 'purchasedmembership')
                   <div class="card">
             
              <div class="card-body">
                <table class="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Code</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Expiry</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody> 
              <?php $i=1 ?> 
                      @foreach($membership as $membership)
                      <?php
                        $memberships = DB::table('membership_configs')->where('membership_code','<=',$membership->membership_code)->first();
                        $exp = App\Member::where('Member_Id', Auth::user()->Member_Id)->first();
                        $date = Carbon\Carbon::now()->format('Y-m-d');
                      ?>
                        <tr>
                         
                          <td>{{ $i++ }}</td>
                          <td>{{ $membership->membership_code}}</td>
                          <td>{{ $memberships->membership_desc }}</td>
                          <td>${{ $membership->membership_amount }}</td>
                           <td>{{ $exp->membershipExpiryDate }}</td>
                          @if($membership->payment_status=='Completed')
                          <td><span class="badge badge-success">Purchased</span></td>
                          @else
                          <td><span class="badge badge-danger">Pending</span></td>
                          @endif
                        

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
                 </div>
            </div>
                @else
                <div class="card">
               <div class="card-header">
                   <h4><center>Entry Tickets</center></h4>
                  </div>
              <div class="card-body">
                 <table class="table table-borderless">
				 <thead>
				 	<th>S.No</th>
					<th>Event Name</th>
					<th>Qty</th>
					<th>Total Amount</th>
				 </thead>
				 <tbody>

			<?php $i=1; 

			?>

				   @foreach($PurchasedEventEntryTickets as $member)
				   <?php
				   $user =  App\User::where('id',$member->userId)->first();
					$event  = App\Event::where('id',$member->eventId)->first();
                    $toalamount = $member['sum']*$member['ticketAmount'];
				   ?>
			           <tr>
			           	 <td> {{ $i++ }} </td>

			             <td>{{ $event['eventName'] }}</td>
			              <td>{{ $member['sum'] }}</td>
			             <td>${{ $toalamount }}</td>
			            
			             
			           </tr>
			         @endforeach
				</tbody>
			  </table>
			   </div>
            </div>
			   <div class="card">
               <div class="card-header">
                   <h4><center>Food Tickets</center></h4>
                  </div>
              <div class="card-body">
			    <table class="table table-borderless">
				 <thead>
				 	<th>S.No</th>
					<th>Event Name</th>
					<th>Qty</th>
					<th>Total Amount</th>
				 </thead>
				 <tbody>

			<?php $i=1; 

			?>

				   @foreach($PurchasedEventFoodTickets as $member)
				   <?php
				   $user =  App\User::where('id',$member->userId)->first();
					$event  = App\Event::where('id',$member->eventId)->first();
                    $toalamount = $member['sum']*$member['ticketAmount'];
				   ?>
			           <tr>
			           	 <td> {{ $i++ }} </td>

			             <td>{{ $event['eventName'] }}</td>
			              <td>{{ $member['sum'] }}</td>
			             <td>${{ $toalamount }}</td>
			            
			             
			           </tr>
			         @endforeach
				</tbody>
			  </table>
			   </div>
            </div>
                @endif
             
        </div>
    </div>
</div>

</section>
</div>

@endsection

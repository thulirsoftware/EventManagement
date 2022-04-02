@extends('layouts.user')
@section('content')
<div class="content-wrapper" style="background-color:white">
  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
     <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
     <div class="col-12">
<br>
  @if(Session::has('success'))
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
<?php
            $event = Session::get('Events');
            //$event = Event::where('id',$id)->first();
        ?>
 <div class="card card-info" style="-webkit-box-shadow: none;
          -moz-box-shadow: none;  box-shadow: none;background-color: #fff;border: 1px solid rgba(0,0,0.1,0.1);">
        <div class="card-header"  style="background-color: #f5f5fc;color:black">
             <h3 class="card-title" style="color:black">View Purchased Amount Details</h3>
        </div>
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                  </div>
              @endif
                <div class="card-body">
    <form  action="{{ url('memberPaymentCreate') }}" method="POST">
                      {{ csrf_field() }}
     
        <table id="example1" class="table table-borderless" style="border:none">
                                                        
        
         <tr>  
              <td >Event Name</td>
              <td>{{ $event->eventName }}</td> 
        </tr>
       
        <tr> 
              <td >Food Tickets</td>
              <td>${{$FoodAmount}}</td> 
        </tr>
        <tr> 
              <td >Entry Ticket</td>
              <td>${{$EntryTicketAmounts}}</td> 
        </tr>
        <tr> 
              <td >Competition</td>
              <td>${{$compeitionAmounts}}</td> 
        </tr>
        
         <tr> 
              <td >Total Amount</td>
              <td>${{$totalAmount}}</td> 
        </tr>
        <tr>
          <td>Payment Type</td>
          <td>
          
          <input class="form-check-input" type="radio" class="minimal" id="paypal" name="payment_type" value="paypal" checked>&nbsp;&nbsp;Paypal
           </td>

        </tr>

        
       </table>
       <?php
       ?>
          @if(count($foodTickets)>0)

          <div class="card-header" style="border-bottom:none"><center><strong>Food Ticket</strong></center></div>
          @if(count($foodTickets)>0)
          <table class="table table-bordered table-striped">
                <thead>
                  <th>S.No</th>
                  <th>Age Group</th>
                  <th>Food Type</th>
                  <th>Qty</th>
                  <th>Ticket Amount</th>
                </thead>
                <tbody>
                  <?php $i=1; 

                ?>

                @foreach($foodTickets as $Purchasedfoodticket)
                <?php

                $ageGroup="";
                      if($Purchasedfoodticket['min_age']>=18)
                      {
                        $ageGroup = "Adult";
                      }
                      else 
                      {
                        $ageGroup = "Kids";
                      }
                      $foodAmount = $FoodAmount *$totalFoodticket;

              ?>
              <tr>
                <td> {{ $i++ }} </td>

                <td>{{ $ageGroup }}</td>
                <td>{{ $Purchasedfoodticket['foodType'] }}</td>

                <td>{{ $totalFoodticket}}</td>
                <?php 
                $totalAmount = $Purchasedfoodticket['no_of_tickets']*$Purchasedfoodticket['ticketAmount'];
              ?>
                <td>${{ $foodAmount }}</td>
                
                
              </tr>
              @endforeach
                
            </tbody>
          </table>
            @endif
          @endif
            @if(count($entryTickets)>0)

          <div class="card-header" style="border-bottom:none"><center><strong>Entry Ticket</strong></center></div>
          @if(count($entryTickets)>0)
          <table class="table table-bordered table-striped">
                <thead>
                  <th>S.No</th>
                  <th>Age Group</th>
                  <th>Qty</th>
                  <th>Ticket Amount</th>
                </thead>
                <tbody>
                  <?php $i=1; 

                ?>

                @foreach($entryTickets as $entryTicket)
                <?php

                $ageGroup="";
                      if($entryTicket['min_age']>=18)
                      {
                        $ageGroup = "Adult";
                      }
                      else 
                      {
                        $ageGroup = "Kids";
                      }
                      $entryAmount = $EntryTicketAmounts *$totalEntryticket;

              ?>
              <tr>
                <td> {{ $i++ }} </td>

                <td>{{ $ageGroup }}</td>

                <td>{{ $totalEntryticket}}</td>
               
                <td>${{ $entryAmount }}</td>
                
                
              </tr>
              @endforeach
                
            </tbody>
          </table>
            @endif
          @endif
          <?php
          ?>
          @if( $competitionData!=null)
           @if(count($competitionData['competition_id'])>0)

          <div class="card-header" style="border-bottom:none"><center><strong>Competition</strong></center></div>
          @if(count($competitionData['competition_id'])>0)
          <table class="table table-bordered table-striped">
                <thead>
                  <th>Name</th>
                  <th>Competition Name</th>
                  <th>Group Name</th>
                  
                  <th>Email</th>
                  <th>Age</th>
                </thead>
                <tbody>
                
              @for($i=0; $i<$tmember_feeCount; $i++)
               <?php
                  $compeititon = \App\Competition::where('id',$competitionData['competition_id'][$i])->first();
                   $groupName = \App\GroupNames::where('competition_id',$competitionData['competition_id'][$i])->first();
               ?>
              <tr>
                <td>{{ $competitionData['first_name'][$i] }} {{ $competitionData['last_name'][$i] }}</td>
                <td>{{ $compeititon['name'] }}</td>
                @if($groupName!=null)
                <td>{{ $groupName->name }}</td>
                @else
                <td> - </td>
                @endif
                <td>{{ $competitionData['participant_id'][$i] }}</td>
                <td>{{ $competitionData['age'][$i] }}</td>
              </tr>
              @endfor
                
            </tbody>
          </table>
            @endif
          @endif
           @endif
       <div class="form-group" id="submit">     
        <input class="form-check-input" type="checkbox" name="terms" id="terms" onchange="activateButton(this)">  I solemnly agree that the information provided is true to the best of my knowledge and I am older than 18 years.<br>    
                    <center><br>   
                      <button type="submit" class="btn btn-primary btn-sm" name="submit" disabled="" id="myBtn">Pay</button>
                      <a class="btn btn-warning btn-sm" href="{{ url('memberTickets') }}">Cancel</a>
                    </center>

                  </div>
   </form>
</div>
</div>
</div>
</div>
</div>
</section>
</div>

<script>
 function disableSubmit() {
  document.getElementById("myBtn").disabled = true;
 }

  function activateButton(element) {

      if(element.checked) {
        document.getElementById("myBtn").disabled = false;
       }
       else  {
        document.getElementById("myBtn").disabled = true;
      }

  }
</script>
@endsection

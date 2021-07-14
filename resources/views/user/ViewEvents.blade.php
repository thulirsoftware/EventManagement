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
  		  <div class="col-md-1">
  		  </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background-color: #1f5387;color:white">
                     <h3 class="card-title">{{$events->eventName}}</h3>
                </div>
                <div class="card-body">
                    <center><h3>Competition</h3></center>
                    <hr>
                    <?php
                    $CompetitionRegistered = App\CompetitionRegistered::where('event_id',$events->id)->where('user_id',Auth::user()->id)->get();

                   
                    //dd($Competitions);
                    ?>
                    <div class="row">
                        @foreach($CompetitionRegistered as $CompetitionRegistered)
                        <?php 
                         $Competitions = App\Competition::where('id',$CompetitionRegistered->competition_id)->first();
                    ?>
                    <div class="col-md-1">
                        <p>Name&nbsp;:</p>
                    </div>
                    <div class="col-md-3">
                        <td>{{$Competitions->name}}</td>
                    </div>
                    <div class="col-md-1">
                        <p>Fees&nbsp;:</p>
                    </div>
                    <div class="col-md-3">
                        <td>${{$CompetitionRegistered->fees}}</td>
                    </div>
                     <div class="col-md-2">
                        <p>Participants&nbsp;:</p>
                    </div>
                    <div class="col-md-2">
                        <td>{{$CompetitionRegistered->participant_id}}</td>
                    </div>
                            
                            
               @endforeach
                 </div>   
                                 <hr>

                 <center><h3>Entry Tickets</h3></center>
                <hr>
                    <?php
                    $PurchasedEventEntryTickets = App\PurchasedEventEntryTickets::where('eventId',$events->id)->where('userId',Auth::user()->id)->get();
                   
                    //dd($Competitions);
                    ?>
                    <div class="row">
                        @foreach($PurchasedEventEntryTickets as $PurchasedEventEntryTicket)
                        <?php 
                         $EventEntryTickets = App\EventEntryTickets::where('id',$PurchasedEventEntryTicket->ticketId)->first();
                    ?>
                   
                    <div class="col-md-3">
                        <p>Age Group&nbsp;:</p>
                    </div>
                    <div class="col-md-3">
                        <td>{{$EventEntryTickets->ageGroup}}</td>
                    </div>
                     <div class="col-md-3">
                        <p>Ticket Price&nbsp;:</p>
                    </div>
                    <div class="col-md-3">
                        <td>${{$PurchasedEventEntryTicket->ticketAmount}}</td>
                    </div>
                       
                            
               @endforeach
                 </div>
                  <hr>

                 <center><h3>Food Tickets</h3></center>
                <hr>
                    <?php
                    $PurchasedEventFoodTickets = App\PurchasedEventFoodTickets::where('eventId',$events->id)->where('userId',Auth::user()->id)->get();
                   
                    //dd($Competitions);
                    ?>
                    <div class="row">
                        @foreach($PurchasedEventFoodTickets as $PurchasedEventFoodTicket)
                        <?php 
                         $EventTicket = App\EventTicket::where('id',$PurchasedEventFoodTicket->ticketId)->first();
                    ?>
                    @if($EventTicket!=null)
                   
                    <div class="col-md-2">
                        <p>Age Group&nbsp;:</p>
                    </div>
                    <div class="col-md-2">
                        <td>{{$EventTicket->ageGroup}}</td>
                    </div>
                     <div class="col-md-2">
                        <p>Ticket Price&nbsp;:</p>
                    </div>
                    <div class="col-md-1">
                        <td>${{$PurchasedEventFoodTicket->ticketAmount}}</td>
                    </div>
                    <div class="col-md-1">
                        <p>Food&nbsp;:</p>
                    </div>
                    <div class="col-md-1">
                        <td>{{$EventTicket->foodType}}</td>
                    </div>
                    <div class="col-md-3">
                    </div>
                    @endif
                       
                            
               @endforeach
                 </div>      
            </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
@endsection

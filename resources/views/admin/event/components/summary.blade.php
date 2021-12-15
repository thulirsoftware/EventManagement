<br>
    <?php 
        $TotalEntryTicketsKidMember=0;
        $TotalEntryTicketsAdultMember=0;
        $TotalEntryTicketsKidsNonMember=0;
        $TotalEntryTicketsAdultNonMember=0;

    ?>
     @foreach($Purchased_Entry_Tickets as $Purchased_Entry_Ticket)
      <?php

       $TotalEntryTicketsKidMember =  \App\Http\Controllers\EventController::getEventTickets($Purchased_Entry_Ticket['eventId'],'<=','Member','16');
     


       $TotalEntryTicketsAdultMember =  \App\Http\Controllers\EventController::getEventTickets($Purchased_Entry_Ticket['eventId'],'>','Member','16');

      
     
       $TotalEntryTicketsKidsNonMember  = \App\Http\Controllers\EventController::getEventTickets($Purchased_Entry_Ticket['eventId'],'<=','NonMember','16');
     
     
       $TotalEntryTicketsAdultNonMember =  \App\Http\Controllers\EventController::getEventTickets($Purchased_Entry_Ticket['eventId'],'>','NonMember','16');
      

    ?>
      
     @endforeach
         <h4><center>Entry Tickets</center></h4>

      <table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
       
       <tr>
        <th>Age Group</th>
        <th>Member/Non Member</th>
        <th>No Of Tickets</th>
    </tr>
</thead>
<tbody>
   <tr>
        <td>Kids</td>
        <td>Member</td>
        <td>{{$TotalEntryTicketsKidMember}}</td>
    </tr>
     <tr>
        <td>Adult</td>
        <td>Member</td>
        <td>{{ $TotalEntryTicketsAdultMember}}</td>
    </tr>
    <tr>
        <td>Kids</td>
        <td>Non Member</td>
        <td>{{ $TotalEntryTicketsKidsNonMember}}</td>
    </tr>
     <tr>
        <td>Adult</td>
        <td>Non Member</td>
        <td>{{ $TotalEntryTicketsAdultNonMember}}</td>
    </tr>
  </tbody>
</table>
<h4><center>Food Tickets</center></h4>

 <?php 
        $TotalFoodTicketsKidVegMember=0;
        $TotalFoodTicketsKidNonVegMember=0;
        $TotalFoodTicketsKidNoFoodMember=0;

        $TotalFoodTicketsAdultVegMember=0;
        $TotalFoodTicketsAdultNonVegMember=0;
        $TotalFoodTicketsAdultNoFoodMember=0;

        $TotalFoodTicketsKidVegNonMember=0;
        $TotalFoodTicketsKidNonVegNonMember=0;
        $TotalFoodTicketsKidNoFoodNonMember=0;

        $TotalFoodTicketsAdultVegNonMember=0;
        $TotalFoodTicketsAdultNonVegNonMember=0;
        $TotalFoodTicketsAdultNoFoodNonMember=0;


    ?>
     @foreach($Purchased_Food_Tickets as $Purchased_Food_Ticket)
      <?php
      $TotalFoodTicketsKidVegMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'<=','Member','veg','16');
       $TotalFoodTicketsKidNonVegMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'<=','Member','nveg','16');

        $TotalFoodTicketsKidNoFoodMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'<=','Member','nfood','16');
        $TotalFoodTicketsAdultVegMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'>','Member','veg','16');
        $TotalFoodTicketsAdultNonVegMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'>','Member','nveg','16');
        $TotalFoodTicketsAdultNoFoodMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'>','Member','nfood','16');


        $TotalFoodTicketsKidVegNonMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'<=','NonMember','veg','16');
        $TotalFoodTicketsKidNonVegNonMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'<=','NonMember','nveg','16');
        $TotalFoodTicketsKidNoFoodNonMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'<=','NonMember','nfood','16');

         $TotalFoodTicketsAdultVegNonMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'>','NonMember','veg','16');
        $TotalFoodTicketsAdultNonVegNonMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'>','NonMember','nveg','16');
        $TotalFoodTicketsAdultNoFoodNonMember = \App\Http\Controllers\EventController::getFoodTickets($Purchased_Food_Ticket['eventId'],'>','NonMember','nfood','16');

    ?>
     @endforeach
     <table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
       
       <tr>
        <th>Age Group</th>
        <th>Member/Non Member</th>
        <th>Food Type</th>
        <th>No Of Tickets</th>
    </tr>
</thead>
<tbody>
   <tr>
        <td>Kids</td>
        <td>Member</td>
        <td>Veg</td>
        <td>{{$TotalFoodTicketsKidVegMember}}</td>
    </tr>
    <tr>
        <td>Kids</td>
        <td>Member</td>
        <td>Non Veg</td>
        <td>{{$TotalFoodTicketsKidNonVegMember}}</td>
    </tr>
    <tr>
        <td>Kids</td>
        <td>Member</td>
        <td>No Food</td>
        <td>{{$TotalFoodTicketsKidNoFoodMember}}</td>
    </tr>
    <tr>
        <td>Adult</td>
        <td>Member</td>
        <td>Veg</td>
        <td>{{$TotalFoodTicketsAdultVegMember}}</td>
    </tr>
    <tr>
        <td>Adult</td>
        <td>Member</td>
        <td>Non Veg</td>
        <td>{{$TotalFoodTicketsAdultNonVegMember}}</td>
    </tr>
    <tr>
        <td>Adult</td>
        <td>Member</td>
        <td>No Food</td>
        <td>{{$TotalFoodTicketsAdultNoFoodMember}}</td>
    </tr>
     <tr>
        <td>Kids</td>
        <td>Non Member</td>
        <td>Veg</td>
         <td>{{$TotalFoodTicketsKidVegNonMember}}</td>
    </tr>
    <tr>
        <td>Kids</td>
        <td>Non Member</td>
        <td>Non Veg</td>
        <td>{{$TotalFoodTicketsKidNonVegNonMember}}</td>
    </tr>
    <tr>
        <td>Kids</td>
        <td>Non Member</td>
        <td>No Food</td>
        <td>{{$TotalFoodTicketsKidNoFoodNonMember}}</td>
    </tr>
    <tr>
        <td>Adult</td>
        <td>Non Member</td>
        <td>Veg</td>
       <td>{{$TotalFoodTicketsAdultVegNonMember}}</td>
    </tr>
    <tr>
        <td>Adult</td>
        <td>Non Member</td>
        <td>Non Veg</td>
        <td>{{$TotalFoodTicketsAdultNonVegNonMember}}</td>
    </tr>
    <tr>
        <td>Adult</td>
        <td>Non Member</td>
        <td>No Food</td>
        <td>{{$TotalFoodTicketsAdultNoFoodNonMember}}</td>
    </tr>
     
  
  </tbody>
</table>
<h4><center>Competition</center></h4>

    
      <table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
       
       <tr>
        <th>Competition Name</th>
        <th>No Of Participants</th>
    </tr>
</thead>
<tbody>
    @foreach($CompetitionRegistration as $CompetitionRegistered)
     <?php 
     $Competition = \App\Competition::where('id',$CompetitionRegistered['competition_id'])->first();
     $EventCompetition = \App\EventCompetition::where('competition_id',$CompetitionRegistered['competition_id'])->first();
    if($Competition->competition_type=="group")
    {
      $noOfParticipants= "1";

    }
    
    else
    {
      $fee= $EventCompetition['member_fee'];
      $noOfParticipants= "1";
    }
      ?>
   <tr>
        <td>{{$Competition->name}}</td>
        <td>{{$noOfParticipants}}</td>
    </tr>
  
      @endforeach
    </tbody>
</table>
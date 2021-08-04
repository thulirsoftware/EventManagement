@extends('layouts.admin')

@section('content')
<style>
.notice {
  padding: 15px;
  background-color: #fafafa;
  border-left: 6px solid #7f7f84;
  margin-bottom: 10px;
  -webkit-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
  -moz-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
  box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
}
.notice-sm {
  padding: 10px;
  font-size: 80%;
}
.notice-lg {
  padding: 35px;
  font-size: large;
}
.notice-info {
  border-color: #45ABCD;
}
.notice-success {
  border-color:green;
}


.boxed {
  width: 25px;
  height: 25px;
  background-color: #4bb8a9;
  color: white;
  text-align: center;
}

</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">  
       <div class="col-12">

          <div class="row mb-2">
            <div class="col-sm-2">
              <a href="/admin/manageEvent" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-8">
          </div>
          <div class="col-sm-2">

          </div>
      </div>
  </div><br>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Event</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <form method="post" action="{{ url('admin/eventUpdate') }}" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="modal-body">


              <input type="hidden" name="id" value="{{ $event['id'] }}">
              <div class="col-md-12">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="names">Event Name&nbsp;<span style="color:red">*</span></label>
                    <input type="text" class="form-control"  name="eventName" value="{{ $event['eventName'] }}" required="">
                </div>
                <div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="exampleInputFile">Event Picture</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="eventFlyer" id="exampleInputFile" onchange="showname()">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                      </div>
                  </div>
              </div>
              <div id="editor"></div>
          </div>


      </div>

      <div class="row">
          <div class="col-md-4 form-group ">
            <label class="names">Venue&nbsp;<span style="color:red">*</span></label>
            <input class="form-control" type="text" name="eventLocation" value="{{ $event['eventLocation'] }}" required="">
        </div>

        <div class="col-md-4 form-group ">
            <label class="names">Date&nbsp;<span style="color:red">*</span></label>
            <input class="form-control" type="date" name="eventDate" value="{{ $event['eventDate'] }}" required="">
        </div>
        <div class="form-group col-md-4">
            <label class="names">Time&nbsp;<span style="color:red">*</span></label>
            <input class="form-control" type="time" name="eventTime" value="{{ $event['eventTime'] }}">
        </div>
    </div>




</div>
</div>
<div class="modal-footer">
  <input type="submit"  class="next btn btn-primary btn-md" name="Submit" value="Update">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>

</div>

</div>
</div>


<div class="card">
   @if(Session::has('success'))
   <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      {{Session::get('success')}}
  </div>
  @endif
  <div class="card-body">
      <section id="tabs" class="project-tab">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Events</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Entry Ticket</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Food Ticket</a>
            <a class="nav-item nav-link" id="nav-competition-tab" data-toggle="tab" href="#nav-competition" role="tab" aria-controls="nav-competition" aria-selected="false">Competition</a>
            <a class="nav-item nav-link" id="nav-summary-tab" data-toggle="tab" href="#nav-summary" role="tab" aria-controls="nav-summary" aria-selected="false">Summary</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><br>
         <table class="table table-striped table-bordered" id="event_edit_list">
            <thead style="background-color: white;">
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
          <?php $i=1 ?> 
          <?php
          $string = str_replace(" ","\r\n",$event['eventName']);
          ;
          $newtext = wordwrap($event['eventName'], 20, "\n");
      ?>
      <tr>

          <td>{!! nl2br(e($newtext)) !!}</td>
          <td>{{ $event['eventDate'] }}</td>
          <td>{{ $event['eventTime'] }}</td>
          <td>{{ $event['eventLocation'] }}</td>
          <td><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit" style="text-align:center;"></i>&nbsp;</button>&nbsp;&nbsp;<a onclick="DeleteEvent({{$event['id']}})"  > <i class="fa fa-trash" style="cursor:pointer;color:#0069d9"></i></a></td>
      </tr>
  </tbody> 
</table>
</div>
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <br>
    <div class="add-button" >
      <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/Event/addEventEntryTicket',$event['id']) }}">Add</a> 
  </div><br><br>
  <table class="table table-bordered table-striped" id="event_entry_list">
      <thead style="background-color:white">
        <tr>
          <th>Min Age</th>
          <th>Max Age</th>
          <th>Member Type</th>
          <th>Ticket Price</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody >
    <?php $i = 1 ?>  
    @foreach($eventTicket as $ticket)
    <tr id="row_event_{{ $ticket['id'] }}">

      <?php
      $event = \App\Event::where('id',$ticket['eventId'])->first();
  ?>
  <td id="row_entry_age{{ $ticket['id'] }}">{{ $ticket['min_age'] }}</td>
  <td id="row_entry_max_age{{ $ticket['id'] }}">{{ $ticket['max_age'] }}</td>
  <td id="row_entry_type{{ $ticket['id'] }}">{{ $ticket['memberType'] }}</td>
  <td id="row_entry_price{{ $ticket['id'] }}">${{ $ticket['ticketPrice'] }}</td>
  <td>
      <a style="cursor:pointer;color:#0069d9" onclick="edit_Entry_row('{{ $ticket['id'] }}')" id="row_entry_edit{{ $ticket['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>

      <input type="button" id="entry_save_button{{ $ticket['id'] }}" value="Save" class="btn btn-primary" onclick="save_Entry_row('{{ $ticket['id'] }}')" style="display:none">
      &nbsp;&nbsp;
      <a id="row_entry_delete{{ $ticket['id'] }}" onclick="DeleteEntryTicket({{ $ticket['id'] }})"><i class="fa fa-trash fa-lg" style="cursor:pointer;color:#0069d9"></i></a>
  </td>

</tr>
@endforeach
</tbody>
</table>

</div>
<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><br>
   <div class="add-button" >
      <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/Event/addEventFoodTicket',$event['id']) }}">Add</a> 
  </div><br><br>
  <table class="table table-bordered table-striped" id="event_food_list">
      <thead style="background-color:white">
        <tr>
          <th>Min Age</th>
          <th>Max Age</th>
          <th>Member Type</th>
          <th>Food Type</th>
          <th>Ticket Price</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody >
    <?php $i = 1 ?>  
    @foreach($eventFoodTicket as $ticket)
    <tr id="row_food_{{ $ticket['id'] }}">

      <td id="row_food_event_age{{ $ticket['id'] }}">{{ $ticket['min_age'] }}</td>
      <td id="row_food_event_max_age{{ $ticket['id'] }}">{{ $ticket['max_age'] }}</td>
      <td id="row_food_event_type{{ $ticket['id'] }}">{{ $ticket['memberType'] }}</td>
      <td id="row_food_event_food{{ $ticket['id'] }}">{{ $ticket['foodType'] }}</td>
      <td id="row_food_event_price{{ $ticket['id'] }}">{{ $ticket['ticketPrice'] }}</td>

      <td>
        <a  id="row_food_edit{{ $ticket['id'] }}" style="cursor:pointer;color:#0069d9" onclick="edit_row('{{ $ticket['id'] }}')">
          <i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i>
      </a>
      <input type="button" id="food_save_button{{ $ticket['id'] }}" value="Save" class="btn btn-primary" onclick="save_Food_row('{{ $ticket['id'] }}')" style="display:none">
      <a  onclick="DeleteEventFoodTicket({{$ticket['id']}})" id="row_food_delete{{ $ticket['id'] }}"><i class="fa fa-trash fa-lg" style="cursor:pointer;color:#0069d9"></i></a>
  </td>


</tr>
@endforeach
</tbody>
</table>
</div>
<div class="tab-pane fade" id="nav-competition" role="tabpanel" aria-labelledby="nav-competition-tab"><br>

 <div class="add-button" >
    <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/Event/addCompetition',$event['id']) }}">Add</a> 
</div><br><br>
<table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
      <tr>
        <th>Competition Name</th>
        <th>Member Fees </th>
        <th>Non Member Fees</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody >
  <?php $i = 1 ?>  
  @foreach($Competition as $Competition)
  <?php
  $EventCompetition = \App\EventCompetition::where('competition_id',$Competition['id'])->first();
  $CompetitionRegistered = \App\CompetitionRegistered::where('competition_id',$Competition['id'])->where('event_id',$id)->count();

?>
<tr id="row_competition_{{ $Competition['id'] }}">
   <td>{{$Competition->name}}</td>
   <td id="row_competition_mFee{{ $Competition['id'] }}">{{ $EventCompetition['member_fee'] }}</td>
   <td id="row_competition_nonFee{{ $Competition['id'] }}">{{ $EventCompetition['non_member_fee'] }}</td>

   <td>
      <a  id="row_competition_edit{{ $Competition['id'] }}" style="cursor:pointer;color:#0069d9" onclick="edit_row_competition('{{ $Competition['id'] }}')">
        <i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i>
    </a>
    <input type="button" id="Competition_save_button{{ $Competition['id'] }}" value="Save" class="btn btn-primary" onclick="save_competition_row('{{ $Competition['id'] }}')" style="display:none">&nbsp;&nbsp;
    @if($CompetitionRegistered<=0)
    <a onclick="myFunction({{$Competition['id']}})"  id="row_Competition_delete{{ $Competition['id'] }}"  style="cursor:pointer;color:#0069d9"> <i class="fa fa-trash" ></i></a>
    @endif
</td>


</tr>
@endforeach
</tbody>
</table>
</div>
<div class="tab-pane fade" id="nav-summary" role="tabpanel" aria-labelledby="nav-summary-tab"><br>
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
</div>           
</div>

</div>
</section>




</div>

</div>

</div>
</div>
</div>
</div>
</section>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
//redirect to specific tab
$(document).ready(function () {
  console.log("{{ old('tab') }}");
  if("{{ old('tab') }}"=="")
  {
     var nav = localStorage.getItem('nav');
     $('#nav-tab a[href="#'+nav+'"]').tab('show')
 }
 else{
  $('#nav-tab a[href="#{{ old('tab') }}"]').tab('show')
}

});
</script>
<script>
  function edit_row(no)
  {
    document.getElementById("row_food_delete"+no).style.display="none";
    document.getElementById("row_food_edit"+no).style.display="none";
    document.getElementById("food_save_button"+no).style.display="block";

    var row_food_event_age=document.getElementById("row_food_event_age"+no);
    var row_food_event_max_age=document.getElementById("row_food_event_max_age"+no);
    
    var row_food_event_type=document.getElementById("row_food_event_type"+no);
    var row_food_event_food=document.getElementById("row_food_event_food"+no);
    var row_food_event_price=document.getElementById("row_food_event_price"+no);

    var row_food_event_age_data=row_food_event_age.innerHTML;
    var row_food_event_max_age_data=row_food_event_max_age.innerHTML;
    var row_food_event_type_data=row_food_event_type.innerHTML;
    var row_food_event_food_data=row_food_event_food.innerHTML;
    var row_food_event_price_data=row_food_event_price.innerHTML;

    row_food_event_max_age.innerHTML="<input type='text' id='row_food_event_max_age_text"+no+"' class='form-control'  value='"+row_food_event_max_age_data+"'>";

    row_food_event_age.innerHTML="<input type='text' id='row_food_event_age_text"+no+"' class='form-control'  value='"+row_food_event_age_data+"'>";

    row_food_event_type.innerHTML="<input type='text' id='row_food_event_type_text"+no+"' class='form-control' value='"+row_food_event_type_data+"'>";
    row_food_event_food.innerHTML="<input type='text' id='row_food_event_food_text"+no+"' class='form-control' value='"+row_food_event_food_data+"'>";

    row_food_event_price.innerHTML="<input type='text' id='row_food_event_price_text"+no+"' class='form-control' value='"+row_food_event_price_data+"'>";

}
function save_Food_row(no)
{
 var row_food_event_age_val=document.getElementById("row_food_event_age_text"+no).value;
 var row_food_event_max_age_val=document.getElementById("row_food_event_max_age_text"+no).value;
 var row_food_event_type_val=document.getElementById("row_food_event_type_text"+no).value;
 var row_food_event_food_val=document.getElementById("row_food_event_food_text"+no).value;
 var row_food_event_price_val=document.getElementById("row_food_event_price_text"+no).value;

 let _token   = $('meta[name="csrf-token"]').attr('content');
 var table = $('#event_food_list').DataTable();
 $.ajax({
    url: "/admin/UpdateEventFoodTicket",
    type:"POST",
    data:{
      event_min_age:row_food_event_age_val,
      event_max_age:row_food_event_max_age_val,
      event_type:row_food_event_type_val,
      event_food:row_food_event_food_val,
      event_price:row_food_event_price_val,
      event_food_id:no,
      _token: _token
  },
  success:function(response){
      console.log(response);
      if(response) {
        localStorage.setItem('nav','nav-contact');
        window.location.reload();
    }
},
});
}
/*Event Entry Ticket*/

function edit_Entry_row(no)
{
  document.getElementById("row_entry_delete"+no).style.display="none";
  document.getElementById("row_entry_edit"+no).style.display="none";
  document.getElementById("entry_save_button"+no).style.display="block";
  
  var row_entry_event_age=document.getElementById("row_entry_age"+no);
  var row_entry_event_max_age=document.getElementById("row_entry_max_age"+no);
  var row_entry_event_type=document.getElementById("row_entry_type"+no);
  var row_entry_event_price=document.getElementById("row_entry_price"+no);

  var row_entry_event_age_data=row_entry_event_age.innerHTML;
  var row_entry_event_max_age_data=row_entry_event_max_age.innerHTML;

  var row_entry_event_type_data=row_entry_event_type.innerHTML;
  var row_entry_event_price_data=row_entry_event_price.innerHTML;

  row_entry_event_max_age.innerHTML="<input type='text' id='row_entry_event_max_age_text"+no+"' class='form-control'  value='"+row_entry_event_max_age_data+"'>";

  row_entry_event_age.innerHTML="<input type='text' id='row_entry_event_age_text"+no+"' class='form-control'  value='"+row_entry_event_age_data+"'>";

  row_entry_event_type.innerHTML="<input type='text' id='row_entry_event_type_text"+no+"' class='form-control' value='"+row_entry_event_type_data+"'>";

  row_entry_event_price.innerHTML="<input type='text' id='row_entry_event_price_text"+no+"' class='form-control' value='"+row_entry_event_price_data+"'>";

}
function save_Entry_row(no)
{
   var row_entry_event_age_val=document.getElementById("row_entry_event_age_text"+no).value;
   var row_entry_event_max_age_val=document.getElementById("row_entry_event_max_age_text"+no).value;
   var row_entry_event_type_val=document.getElementById("row_entry_event_type_text"+no).value;
   var row_entry_event_price_val=document.getElementById("row_entry_event_price_text"+no).value;

   let _token   = $('meta[name="csrf-token"]').attr('content');

   $.ajax({
      url: "/admin/UpdateEventEntryTicket",
      type:"POST",
      data:{
        event_min_age:row_entry_event_age_val,
        event_max_age:row_entry_event_max_age_val,
        event_type:row_entry_event_type_val,
        event_price:row_entry_event_price_val,
        event_entry_id:no,
        _token: _token
    },
    success:function(response){
        console.log(response);
        if(response) {
          localStorage.setItem('nav','nav-profile');
          window.location.reload();
            //$("#ajaxform")[0].reset();
        }
    },
});

}

/*Compeitition*/

function edit_row_competition(no)
{
  document.getElementById("row_Competition_delete"+no).style.display="none";
  document.getElementById("row_competition_edit"+no).style.display="none";
  document.getElementById("Competition_save_button"+no).style.display="block";
  
  var row_competition_mFee=document.getElementById("row_competition_mFee"+no);
  var row_competition_nonFee=document.getElementById("row_competition_nonFee"+no);

  var row_competition_mFee_data=row_competition_mFee.innerHTML;
  var row_competition_nonFee_data=row_competition_nonFee.innerHTML;

  row_competition_mFee.innerHTML="<input type='text' id='row_competition_mFee_text"+no+"' class='form-control' value='"+row_competition_mFee_data+"'>";

  row_competition_nonFee.innerHTML="<input type='text' id='row_competition_nonFee_text"+no+"' class='form-control' value='"+row_competition_nonFee_data+"'>";

}
function save_competition_row(no)
{
  var row_competition_mFee_val=document.getElementById("row_competition_mFee_text"+no).value;
  var row_competition_nonFee_val=document.getElementById("row_competition_nonFee_text"+no).value;

  let _token   = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/UpdateCompetition",
    type:"POST",
    data:{
      competition_fee:row_competition_mFee_val,
      competition_nonfee:row_competition_nonFee_val,
      event_competition_id:no,
      _token: _token
  },
  success:function(response){
      console.log(response);
      if(response) {
         localStorage.setItem('nav','nav-competition');
         window.location.reload();
            //$("#ajaxform")[0].reset();
        }
    },
});

}
function myFunction(id) {
   if (confirm("Are you Sure you want to delete the competiton for the event?")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/DeleteEventCompetition')}}',
        data : {'id':id},
        success:function(data){
          localStorage.setItem('nav','nav-competition');
          window.location.reload();
      } 
  });

  } else {

  }
}
function DeleteEvent(id) {
   if (confirm("Are you Sure you want to delete the event?")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/eventDelete')}}',
        data : {'id':id},
        success:function(data){
          window.location.reload();
      } 
  });

  } else {

  }
}
function DeleteEntryTicket(id) {
   if (confirm("Are you Sure you want to delete the Entry Ticket for the event?")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/eventTicketDelete')}}',
        data : {'id':id},
        success:function(data){
          localStorage.setItem('nav','nav-profile');
          window.location.reload();
      } 
  });

  } else {

  }
}

function DeleteEventFoodTicket(id) {
   if (confirm("Are you Sure you want to delete the Entry Food for the event?")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/Event/FoodTicket/Delete/')}}',
        data : {'id':id},
        success:function(data){
          localStorage.setItem('nav','nav-contact');
          window.location.reload();
      } 
  });

  } else {

  }
}
</script>



@endsection
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
       <div class="col-12">

          <div class="row mb-2">
            <div class="col-sm-2">
              <a href="/MyEvents" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-7">
          </div>
          <div class="col-sm-3">
            <a href="/EditmemberBuyTicket/{{$id}}" class="btn btn-primary btn-sm" >Add More Tickets</i>&nbsp;</a>

          </div>
      </div>
  </div><br>


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
        
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Entry Ticket</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Food Ticket</a>
          <a class="nav-item nav-link" id="nav-competition-tab" data-toggle="tab" href="#nav-competition" role="tab" aria-controls="nav-competition" aria-selected="false">Competition</a>
      </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><br>
        <?php
     $TotalEntryTicket = \App\PurchasedEventEntryTickets::where('eventId',$id)->where('userId',Auth::user()->id)->where('ticketQty','!=',null)->count();
    ?>
        <div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-2">
                <h4 style="color:green"><b>No Of Tickets :</b> </h4>
            </div>
            <div class="col-md-1">
                <h5>{{$TotalEntryTicket}}</h5>
            </div>
        </div><br>
      <table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
       
       <tr>
        <th>Age Group</th>
        <th>Ticket Price</th>
        <th>No Of Tickets</th>
         <th>Price</th>
    </tr>
</thead>
<tbody >
  <?php $i = 1 ?> 
  <?php
  if(Auth::user()->Member_Id!=null)
            {
                $type="Member";

            }
            else
            {
                $type="NonMember";
            }
           

    $EventEntryTickets = \App\EventEntryTickets::where('eventId',$id)->first();
    $totalAmount=0;
    ?> 

  @foreach($Purchased_Entry_Tickets as $Purchased_Entry_Ticket)
  <?php
            if(Auth::user()->Member_Id!=null)
            {
                $type="Member";

            }
            else
            {
                $type="NonMember";
            }
          $EventEntryTickets = \App\EventEntryTickets::where('eventId',$Purchased_Entry_Ticket['eventId'])->where('id',$Purchased_Entry_Ticket['ticketId'])->first();

           $TotalEntryTicket = \App\PurchasedEventEntryTickets::where('eventId',$id)->where('userId',Auth::user()->id)->count();

            $ageGroup="";
            if($EventEntryTickets['max_age']<="9")
            {
              $ageGroup = "Kids";
            }
            else 
            {
              $ageGroup = "Adult";
            }
            $totalPrice = $EventEntryTickets['ticketPrice']*$Purchased_Entry_Ticket['ticketQty'];
            $totalAmount = $totalAmount+$totalPrice;

?>
<tr>
<td>{{ $ageGroup }}</td>
<td>${{ $EventEntryTickets['ticketPrice'] }}</td>
<td>{{ $Purchased_Entry_Ticket['ticketQty'] }}</td>
<td>${{$totalPrice}}</td>
  </tr>
@endforeach
</tbody>
</table>
<div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-2">
                <h4 style="color:green"><b>Total Amount :</b> </h4>
            </div>
            <div class="col-md-1">
                <h5>${{$totalAmount}}</h5>
            </div>
        </div><br>
</div>

<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><br>
    <?php
     $TotalFoodTicket = \App\PurchasedEventFoodTickets::where('eventId',$id)->where('userId',Auth::user()->id)->where('ticketQty','!=',null)->count();
    ?>
        <div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-2">
                <h4 style="color:green"><b>No Of Tickets :</b> </h4>
            </div>
            <div class="col-md-1">
                <h5>{{$TotalFoodTicket}}</h5>
            </div>
        </div><br>
      <table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
       
       <tr>
        <th>Age Group</th>
        <th>Food Type</th>
        <th>Ticket Price</th>
        <th>No Of Tickets</th>
         <th>Price</th>
    </tr>
</thead>
<tbody >
  <?php $i = 1 ?> 
  <?php
  if(Auth::user()->Member_Id!=null)
            {
                $type="Member";

            }
            else
            {
                $type="NonMember";
            }
           

    $EventEntryTickets = \App\EventTicket::where('eventId',$id)->first();
    $totalAmount=0;
    ?> 

  @foreach($Purchased_Food_Tickets as $Purchased_Food_Ticket)
  <?php
            if(Auth::user()->Member_Id!=null)
            {
                $type="Member";

            }
            else
            {
                $type="NonMember";
            }
          $EventTicket = \App\EventTicket::where('eventId',$Purchased_Food_Ticket['eventId'])->where('id',$Purchased_Food_Ticket['ticketId'])->first();
           $TotalEntryTicket = \App\PurchasedEventFoodTickets::where('eventId',$id)->where('userId',Auth::user()->id)->count();

            $ageGroup="";
            if($EventTicket['max_age']<="9")
            {
              $ageGroup = "Kids";
            }
            else 
            {
              $ageGroup = "Adult";
            }
            $totalPrice = $EventTicket['ticketPrice']*$Purchased_Food_Ticket['ticketQty'];
            $totalAmount = $totalAmount+$totalPrice;

?>
<tr>
<td>{{ $ageGroup }}</td>
<td>{{ $EventTicket['foodType'] }}</td>
<td>${{ $EventTicket['ticketPrice'] }}</td>
<td>{{ $Purchased_Food_Ticket['ticketQty'] }}</td>
<td>${{$totalPrice}}</td>
  </tr>
@endforeach
</tbody>
</table>
<div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-2">
                <h4 style="color:green"><b>Total Amount :</b> </h4>
            </div>
            <div class="col-md-1">
                <h5>${{$totalAmount}}</h5>
            </div>
        </div><br>
</div>
<div class="tab-pane fade" id="nav-competition" role="tabpanel" aria-labelledby="nav-competition-tab"><br>
       <?php
     $noOfParticipants = \App\CompetitionRegistered::where('event_id',$id)->where('user_id',Auth::user()->id)->count();
    ?>
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-3">
                <h4 style="color:green"><b>Total No Of Participants :</b> </h4>
            </div>
            <div class="col-md-1">
                <h5>{{$noOfParticipants}}</h5>
            </div>
        </div><br>
<table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
      <tr>
        <th>Competition Name</th>
         <th>Competition Type</th>
        <th>Fees </th>
        <th>No Of Participants </th>
        <th>Participant Names </th>
    </tr>
</thead>
<tbody >
  <?php $i = 1 ?>  
  <?php $totalAmount=0; $participant ="";?>
  @foreach($CompetitionRegistered as $CompetitionRegistered)
  <?php
    $Competition = \App\Competition::where('id',$CompetitionRegistered['competition_id'])->first();
     $EventCompetition = \App\EventCompetition::where('competition_id',$CompetitionRegistered['competition_id'])->first();
    if($Competition->competition_type=="group" && $CompetitionRegistered->participant_id!=null)
    {
      $fee= $EventCompetition['member_fee'];
      $participant = \App\FamilyMember::where('id',$CompetitionRegistered['participant_id'])->first();

    }
    else if($Competition->competition_type=="group" && $CompetitionRegistered->participant_id==null)
    {
      $fee= $EventCompetition['non_member_fee'];
      $participant = null;

    }
     else if($Competition->competition_type=="solo" && $CompetitionRegistered->participant_id!=null)
    {
      $fee= $EventCompetition['member_fee'];
      $noOfParticipants= "1";
      $participant = \App\FamilyMember::where('id',$CompetitionRegistered['participant_id'])->first();

    }
    
    $totalAmount=$totalAmount+$fee;

?>
<tr >
   <td>{{$Competition->name}}</td>
   <td>{{$Competition->competition_type}}</td>
   <td>${{ $fee }}</td>
<td>{{ $noOfParticipants }}</td>
@if($participant!=null)
<td>{{$participant->firstName}} {{$participant->lastName}}</td>
@else
<td></td>
@endif
  </tr>
@endforeach
</tbody>
</table>
 <div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-2">
                <h4 style="color:green"><b>Total Amount :</b> </h4>
            </div>
            <div class="col-md-1">
                <h5>${{$totalAmount}}</h5>
            </div>
        </div><br>
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
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
    <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
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
              <p>{{ $event['eventFlyer'] }}</p>
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
            <input type="text"  name="eventTime" class="form-control timepicker"value="{{ $event['eventTime'] }}"  id="event_time_edit"/>

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
            <a class="nav-item nav-link" id="nav-vip-tab" data-toggle="tab" href="#nav-vip" role="tab" aria-controls="nav-vip" aria-selected="false">VIP / Guest</a>
            <a class="nav-item nav-link" id="nav-summary-tab" data-toggle="tab" href="#nav-summary" role="tab" aria-controls="nav-summary" aria-selected="false">Summary</a>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        @include('admin.event.components.event_detail')
      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
         @include('admin.event.components.entry_tickets_list')

      </div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        @include('admin.event.components.food_tickets_list')
      </div>
      <div class="tab-pane fade" id="nav-competition" role="tabpanel" aria-labelledby="nav-competition-tab">
        @include('admin.event.components.competition_list')
      </div>
       <div class="tab-pane fade" id="nav-vip" role="tabpanel" aria-labelledby="nav-vip-tab">
        @include('admin.event.components.vip')
      </div>   
      <div class="tab-pane fade" id="nav-summary" role="tabpanel" aria-labelledby="nav-summary-tab">
        @include('admin.event.components.summary')
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

    row_food_event_type.innerHTML="<select class='form-control' id='row_food_event_type_text"+no+"'  name='memberType' id='FoodmemberType' required=''><option value='Member'>Member</option><option value='NonMember'>NonMember</option></select>";

    row_food_event_food.innerHTML="<select class='form-control' id='row_food_event_food_text"+no+"' required=''><option value='Veg-Box'>Veg-Box</option><option value='Veg-Banana-Leaf'>Veg-Banana-Leaf</option><option value='Non-Veg-Box'>Non-Veg-Box</option><option value='Non-Veg-Banana-Leaf'>Non-Veg-Banana-Leaf</option><option value='Snack'>Snack</option></select>";

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

  row_entry_event_type.innerHTML="<select class='form-control' id='row_entry_event_type_text"+no+"'  name='memberType' required=''><option value='Member'>Member</option><option value='NonMember'>NonMember</option></select>";

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

 function ApproveEntryTicket(id,status) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/Event/EntryTicket/Validation')}}',
        data : {'id':id,'status':status},
        success:function(data){
          localStorage.setItem('nav','nav-profile');
          window.location.reload();
      } 
  });


}

  function ApproveFoodTicket(id,status) {
       console.log(id);
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/Event/FoodTicket/Validation')}}',
        data : {'id':id,'status':status},
        success:function(data){
          localStorage.setItem('nav','nav-contact');
          window.location.reload();
      } 
  });


}

 function ApproveCompetition(id,status) {
     console.log(id);
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/Event/Competition/Validation')}}',
        data : {'id':id,'status':status},
        success:function(data){
          localStorage.setItem('nav','nav-competition');
          window.location.reload();
      } 
  });


}
</script>



@endsection
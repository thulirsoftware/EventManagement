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
     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/admin/manageEvent" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
      </div>

  </div>
</div>
<div class="row">

  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <form method="post" action="{{ route('admin.duplicateEventSave') }}" enctype="multipart/form-data" id="regForm">

      {{ csrf_field() }}
      <div class="card">
       @if(Session::has('success'))
       <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get('success')}}
    </div>
    @endif
    <div class="card-header"><center><strong>Add Event</strong></center></div>
    <div class="card-body">

       <div class="row">
        <div class="form-group col-md-6">
          <label class="names">Event Name&nbsp;<span style="color:red">*</span></label>
          <input type="text" class="form-control"  name="eventName" required="" value="{{$events->eventName}}">
           <input type="hidden" class="form-control"  name="eventId" required="" value="{{$events->id}}">
      </div>
      <div class="form-group col-md-6">
          <div class="form-group">
            <label for="exampleInputFile">Event Picture</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="eventFlyer" id="exampleInputFile" onchange="showname()">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>

        </div>
    </div>
    <div id="editor"></div>

</div>


</div>

<div class="row">
    <div class="col-md-4 form-group ">
      <label class="names">Venue&nbsp;<span style="color:red">*</span></label>
      <input class="form-control" type="text" name="eventLocation" required="" value="{{$events->eventLocation}}">
  </div>
  <div class="col-md-4 form-group ">
     <?php
     $date =  Carbon\Carbon::tomorrow()->toDateString();
 ?>
 <label class="names">Date&nbsp;<span style="color:red">*</span></label>
 <input class="form-control" type="date" name="eventDate" id="eventDate"  min="{{$date}}" value="{{$events->eventDate}}" required="">
</div>
<div class="form-group col-md-4">
  <label class="names">Time&nbsp;<span style="color:red">*</span></label>
<input type="text"  class="form-control" name="eventTime" id="event_time" value="{{$events->eventTime}}" />
</div>
<div class="form-group col-md-6">
  <label class="names">Judges/Vip/Others&nbsp;<span style="color:red">*</span></label>
  <input class="form-control" type="number" name="free_count" id="free_count"  value="{{$events->free_count}}" >

</div>
</div>

<div class="row">
    <div class="col-md-12"> 
      <!-- radio -->
      <!-- checkbox -->
      <div class="form-group">
        <label class="col-md-3">
          <input type="checkbox" class="minimal" onclick="getEntryforms()" id="EntryCheck" name="EntryCheck" <?=($EntryCount >0)?'checked':''?>>&nbsp;&nbsp;Entry Ticket 
      </label>
      <label class="col-md-3">
          <input type="checkbox" class="minimal" onclick="getFoodforms()" id="FoodCheck" name="FoodCheck" >&nbsp;&nbsp;Food Ticket
      </label>
      <label class="col-md-3">
          <input type="checkbox" class="minimal" name="competitionCheck"   id="CompetitionCheck" <?=($EventCompetitionsCount >0)?'checked':''?>>&nbsp;&nbsp;Competition
      </label>
  </div>
  <div id="EntryDIV" style="display:none">
    <div class="card-header"><center><strong>Add Event Entry Ticket</strong></center></div>
    <br>


    <div class="col-md-12">
      <div class="row">
          <div class="col-md-3 form-group ">
              <label class="names">Min Age</label>
          </div>
          <div class="col-md-3 form-group ">
              <label class="names">Max Age</label>
          </div>
          <div class="col-md-3 form-group ">
              <label class="names">Member</label>

          </div>
          <div class="col-md-2 form-group ">
              <label class="names">Price ($)</label>

          </div>
           <div class="col-md-1 form-group ">
               <a type="button" name="remove"  class="btn btn-success" onclick="AddEntryTicket()"><i class="fa fa-plus"></i></a>


          </div>
      </div>
      <div id="link-list"></div>
      <?php $loop=0;?>
      <div class="row" id="row">
        @foreach($EntryTickets as $i=>$EntryTicket)
        <div class="col-md-3 form-group ">
          <select class="form-control"  name="min_age[]" id="{{$i}}">
        
           @for ($i = 0; $i <=50; $i++)
        }
        }
        <option value="{{ $i }}" <?=($EntryTicket['min_age'] ==$i )?'selected':''?>>{{ $i }}</option>
        @endfor
         </select>
        </div>
         <div class="col-md-3 form-group ">
           <select class="form-control"  name="max_age[]" id="{{$i}}">
           @for ($i = 0; $i <=50; $i++)
        <option value="{{ $i }}" <?=($EntryTicket['max_age'] ==$i )?'selected':''?>>{{ $i }}</option>
        @endfor
         </select>
       
        </div>
         <div class="col-md-3 form-group ">
            <select class="form-control" name="memberType[]" id="{{$i}}">
                <option value="">Select</option>
                <option value="Member" <?=($EntryTicket['memberType'] =='Member' )?'selected':''?>>Member</option>
                <option value="NonMember" <?=($EntryTicket['memberType'] =='NonMember' )?'selected':''?>>NonMember</option>
            </select>
        </div>
<div class="col-md-2 form-group ">
  <input class="form-control" type="text" name="ticketPrice[]" id="{{$i}}" value="{{$EntryTicket['ticketPrice']}}">
</div>
<div class="col-md-1 ">
  <a type="button" name="remove"  class="btn btn-warning spf_btn_remove" id="{{$i}}"><i class="fa fa-trash"></i></a>

</div>
<?php $loop++; ?>
@endforeach

</div>


</div>
</div>
<div id="FoodDIV">
   <div class="card-header"><center><strong>Event Food Ticket</strong></center></div>
   <div class="col-md-12">
  
  <div id="food-list"></div>

  <div class="row" id="row_food0">
  <table class="table table-bordered table-striped" id="Food_table">
                <thead>
                  <tr>
                    <th>Min Age</th>
                    <th>Max Age</th>
                    <th>Member Type</th>
                     <th>Food Type</th>
                    <th>Amount</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
               @foreach($FoodTickets as $i=>$food)
               <tr id="remove_food_row_{{ $food['id'] }}">
                 <td>{{ $food['min_age'] }}</td>
                <td>{{ $food['max_age'] }}</td>
                <td>{{ $food['memberType'] }}</td>
                <td>{{ $food['foodType'] }}</td>
                <td>${{ $food['price'] }}</td>
                <td> <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="AddedFood{{ $food['id'] }}" name="food_id[]" value="{{ $food['id'] }}" onclick="AddedFoodType(this)" checked/>
                <label class="custom-control-label"
                       for="AddedFood{{ $food['id'] }}">
                  </label>
            </div></td>
               </tr>
               @endforeach

            </tbody>
          </table>
</div>



</div>
</div>
<!-- Modal -->
<div class="modal fade" id="FoodModal" tabindex="-1" role="dialog" aria-labelledby="FoodModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="FoodModalLabel">Add Food Tickets</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
           <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Min Age</th>
                    <th>Max Age</th>
                    <th>Member Type</th>
                     <th>Food Type</th>
                    <th>Amount</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($FoodTypes as $food)
              <tr id="food_mod_row_{{ $food['id'] }}">

                <td>{{ $i++ }}</td>

                <td>{{ $food['min_age'] }}</td>
                <td>{{ $food['max_age'] }}</td>
                <td>{{ $food['memberType'] }}</td>
                <td>{{ $food['food_type'] }}</td>
                <td>${{ $food['price'] }}</td>
                <td> <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="customSwitch{{ $food['id'] }}" name="food_id[]" value="{{ $food['id'] }}" onclick="FoodType(this)" />
                <label class="custom-control-label"
                       for="customSwitch{{ $food['id'] }}">
                  </label>
            </div></td>
              

            </tr>
            @endforeach
        </tbody> 
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="CloseFoodModal()">Close</button>
        <button type="button" class="btn btn-primary" onclick="AddFoodType()">Add</button>
      </div>
    </div>
  </div>
</div>

</div>
<!-- /.box -->
</div>
<!-- /.col -->
<div class="col-md-6">

</div>

<!-- /.col -->


<!-- Circles which indicates the steps of the form: -->
<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
</div>

<!-- /.row -->
<div style="overflow:auto;">
  <div style="float:right;">
    <button type="submit" class="button nextBtn" id="nextBtn" >Next</button>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script language="javascript">
$(document).ready(function()
{ 
    $('#EntryCheck').trigger('onclick'); 
    $('#CompetitionCheck').trigger('onclick'); 
});
</script>

<script>
  function showname () {
    var name = document.getElementById('exampleInputFile'); 
    document.getElementById('editor').appendChild(document.createTextNode( name.files.item(0).name));
};
</script>
<script>
  function getEntryforms() {
  // Get the checkbox
  var checkBox = document.getElementById("EntryCheck");
  var x = document.getElementById('EntryDIV');
  if (checkBox.checked == true) {
    x.style.display = "block";
} else {
   x.style.display = "none";
}
}
</script>
<script>
  function getFoodforms() {
  // Get the checkbox
  var checkBox = document.getElementById("FoodCheck");
  if (checkBox.checked == true) {
         $('#FoodModal').modal();
} else {
        $('#FoodModal').modal();
}
}
</script>
<script type="text/javascript">
  function AddedFoodType(foodCheckbox)
  {

    if(foodCheckbox.checked==true)
    {
     
    }
    else {
      $('#remove_food_row_'+foodCheckbox.value).remove();  
    }
  }
</script>
<script>
  function AddFoodType()
  {
     $('#FoodModal').modal('hide');
      var x = document.getElementById('FoodDIV');
    x.style.display = "block";
  }
  function CloseFoodModal()
  {
     $('#FoodModal').modal('hide');
      var x = document.getElementById('FoodDIV');
    x.style.display = "none";
  }
</script>
<script>
 var j=1;
 function AddEntryTicket()
 {
  j++;
  $('<div id="row'+j+'" class="row" >'+'<div class="col-md-3 form-group">'+'<select class="form-control" name="min_age[]" id="min_age'+j+'" ></select>'+'</div>'+'<div class="col-md-3 form-group">'+'<select class="form-control" name="max_age[]" id="max_age'+j+'" ></select>'+'</div>'+'<div class="col-md-3 form-group">'+'<select class="form-control" name="memberType[]" id="sel1"><option value="">Select</option><option value="Member">Member</option><option value="NonMember">NonMember</option></select>'+'</div>'+'<div class="col-md-2 form-group">'+' <input class="form-control" type="text" name="ticketPrice[]" id="ticketPrice_'+j+'" >'+'</div>'+'<div class="col-md-1">'+'<a type="button" name="remove" id="'+j+'" class="btn btn-warning spf_btn_remove" >'+'<i class="fa fa-trash"></i>'+'</a>'+'</div>'+'</div>').appendTo('#link-list');

  $("#ticketPrice_"+j).keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

}); 
  var $select = $("#min_age"+j);
    for (i=0;i<=50;i++){
      $select.append($('<option></option>').val(i).html(i))
    }

     var $select = $("#max_age"+j);
    for (i=0;i<=50;i++){
      $select.append($('<option></option>').val(i).html(i))
    }
   
  $("#ticketPrice").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

}); 
   
}
$(document).on('click', '.spf_btn_remove', function(){  
 var button_idspf = $(this).attr("id");   
 $('#row'+button_idspf+'').remove();  
 $(this).hide();
});
</script>
<script>
 var l=1;
 function AddFoodTicket()
 {
  l++;
  $('<div id="row_food'+l+'" class="row" >'+'<div class="col-md-2 form-group">'+'<select class="form-control"  name="food_min_age[]" id="food_min_age'+l+'"></select>'+'</div>'+'<div class="col-md-2 form-group">'+' <select class="form-control"   name="food_max_age[]" id="food_max_age'+l+'"></select>'+'</div>'+'<div class="col-md-3 form-group">'+'<select class="form-control" name="FoodmemberType[]" id="sel1"><option value="">Select</option><option value="Member">Member</option><option value="NonMember">NonMember</option></select>'+'</div>'+'<div class="col-md-2 form-group">'+'<select class="form-control" name="foodType[]" id="sel1"><option value="">Select</option><option value="veg">Veg</option><option value="nveg">Non-Veg</option><option value="no-food">No Food</option></select>'+'</div>'+'<div class="col-md-2 form-group">'+'<input class="form-control" type="text" name="FoodticketPrice[]" id="FoodticketPrice_'+l+'" >'+'</div>'+'<div class="col-md-1">'+'<a type="button" name="remove" id="'+l+'" class="btn btn-warning spf_btn_remove1" >'+'<i class="fa fa-trash"></i>'+'</a>'+'</div>'+'</div>').appendTo('#food-list');

  $("#FoodticketPrice_"+l).keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

});

  $("#FoodticketPrice").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

});
  var $select = $("#food_max_age"+l);
    for (i=0;i<=50;i++){
      $select.append($('<option></option>').val(i).html(i))
    }

     var $select = $("#food_min_age"+l);
    for (i=0;i<=50;i++){
      $select.append($('<option></option>').val(i).html(i))
    }
 

 

 
}


$(document).on('click', '.spf_btn_remove1', function(){  
 var button_idspf = $(this).attr("id");   
 $('#row_food'+button_idspf+'').remove();  
 $(this).hide();
});
</script>

@endsection
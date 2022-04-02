@extends('layouts.admin')

@section('content')
<style>
            .custom-control-input:focus ~ 
          .custom-control-label::before {
                /* when the button is toggled off 
  it is still in focus and a violet border will appear */
                border-color: violet !important;
                /* box shadow is blue by default
  but we do not want any shadow hence we have set 
  all the values as 0 */
                box-shadow:
                  0 0 0 0rem rgba(0, 0, 0, 0) !important;
            }
  
            /*sets the background color of
          switch to violet when it is checked*/
            .custom-control-input:checked ~ 
          .custom-control-label::before {
                border-color: #5cb85c !important;
                background-color: #5cb85c !important;
            }
  
            /*sets the background color of
          switch to violet when it is active*/
            .custom-control-input:active ~ 
          .custom-control-label::before {
                background-color: #5cb85c !important;
                border-color: #5cb85c !important;
            }
  
            /*sets the border color of switch
          to violet when it is not checked*/
            .custom-control-input:focus:
          not(:checked) ~ .custom-control-label::before {
                border-color: #5cb85c !important;
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

  </div>
</div>
<div class="row">

  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <form method="post" action="{{ url('admin/addEvent') }}" enctype="multipart/form-data" id="regForm">

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
          <input type="text" class="form-control"  name="eventName" required="">
      </div>
      <div class="form-group col-md-6">
          <div class="form-group">
            <label for="exampleInputFile">Event Picture</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="eventFlyer" id="exampleInputFile" onchange="showname()" accept="image/*">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>

        </div>
    </div>
    <div id="editor"></div>

</div>


</div>
<?php
$venue = \App\LocationModel::where('location_for','!=','C')->get();

?>
<div class="row">
    <div class="col-md-4 form-group ">
      <label class="names">Venue&nbsp;<span style="color:red">*</span></label>
      <select  class="form-select"  name="eventLocation" required="">
          <option value="">Select Venue</option>
          @foreach($venue as $venue)
            <option value="{{$venue->location_name}}">{{$venue->location_name}}</option>
          @endforeach
      </select>
  </div>
  <div class="col-md-4 form-group ">
     <?php
     $date =  Carbon\Carbon::tomorrow()->toDateString();
 ?>
 <label class="names">Date&nbsp;<span style="color:red">*</span></label>
 <input class="form-control" type="date" name="eventDate" id="eventDate"  min="{{$date}}" required="">
</div>
<div class="form-group col-md-4">
  <label class="names">Time&nbsp;<span style="color:red">*</span></label>
<input type="text"  class="form-control" name="eventTime" id="event_time"/>
</div>

</div>

<div class="row">
    <div class="col-md-12"> 
      <!-- radio -->
      <!-- checkbox -->
      <div class="form-group">
        <label class="col-md-3">
          <input type="button" class="btn btn-info"  onclick="getEntryforms()" value="Entry Ticket" style="font-weight:bold">
      </label>
      <label class="col-md-3">
        <input type="button" class="btn btn-info"  onclick="getFoodforms()" value="Food Ticket" style="font-weight:bold">
      </label>
      <label class="col-md-1">
          </label>
      <label class="col-md-3">
          <input type="checkbox" class="form-check-input" name="competitionCheck"   id="CompetitionCheck">&nbsp;&nbsp;Competition
      </label>
  </div>
  <div id="EntryDIV" style="display:none">
    <div class="card-header"><center><strong>Added Event Entry Ticket</strong></center></div>
    <br>
 <table class="table table-bordered table-striped" id="Entry_table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Min Age</th>
                    <th>Max Age</th>
                    <th>Member Type</th>
                    <th>Amount</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
</div>
<div id="FoodDIV" style="display:none">
   <div class="card-header"><center><strong>Event Food Ticket</strong></center></div>
   <br>
   <table class="table table-bordered table-striped" id="Food_table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Min Age</th>
                    <th>Max Age</th>
                    <th>Member Type</th>
                     <th>Food Type</th>
                    <th>Amount</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>



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


<!-- Entry Modal -->
<div class="modal fade" id="EntryModal" tabindex="-1" role="dialog" aria-labelledby="EntryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="EntryModalLabel">Add Entry Tickets</h4>
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
                    <th>Amount</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($Entry as $entry)
              <tr id="entry_mod_row_{{ $entry['id'] }}">

                <td>{{ $i++ }}</td>

                <td>{{ $entry['min_age'] }}</td>
                <td>{{ $entry['max_age'] }}</td>
                <td>{{ $entry['member_type'] }}</td>
                <td>${{ $entry['price'] }}</td>
                <td> <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="customSwitch_entry{{ $entry['id'] }}" name="entry_id[]" value="{{ $entry['id'] }}" onclick="getEntryType(this)" />
                <label class="custom-control-label"
                       for="customSwitch_entry{{ $entry['id'] }}">
                  </label>
            </div></td>
              

            </tr>
            @endforeach
        </tbody> 
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
        <button type="button" class="btn btn-primary" onclick="AddEntryType()">Add</button>
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
  <span class="step active" ></span>
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
<script>
  function showname () {
    var name = document.getElementById('exampleInputFile'); 
    document.getElementById('editor').appendChild(document.createTextNode( name.files.item(0).name));
};
</script>
<script>
  function getEntryforms() {
  // Get the checkbox
  var x = document.getElementById('EntryDIV');
    $('#EntryModal').modal();

}
</script>
<script>
  function getFoodforms() {
  // Get the checkbox
  var checkBox = document.getElementById("FoodCheck");
         $('#FoodModal').modal();

}
</script>


<script type="text/javascript">
  function FoodType(foodCheckbox)
  {
  var x = document.getElementById('FoodDIV');

    if(foodCheckbox.checked==true)
    {
      document.getElementById("customSwitch"+foodCheckbox.value).checked = true;
      table_row = document.getElementById("food_mod_row_"+foodCheckbox.value);
     tableBody = $("#Food_table tbody");
       tableBody.append("<tr id=remove-added-row-food"+foodCheckbox.value+"><td>"+table_row.cells[0].innerHTML+"</td><td>"+table_row.cells[1].innerHTML+"</td><td>"+table_row.cells[2].innerHTML+"</td><td>"+table_row.cells[3].innerHTML+"</td><td>"+table_row.cells[4].innerHTML+"</td><td>"+table_row.cells[5].innerHTML+"</td><td><a class='btn btn-warning' id="+foodCheckbox.value+" onclick='DeleteFood(this.id)' style='color:black'><i class='fa fa-trash fa-lg' style='text-align:cenetr;'></i></a></td></tr>");
    }
    else {
      $('#FoodModal').modal();
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
  }
</script>
<script type="text/javascript">
  function getEntryType(entryCheckbox)
  {

    if(entryCheckbox.checked==true)
    {
      document.getElementById("customSwitch_entry"+entryCheckbox.value).checked = true;
      table_row = document.getElementById("entry_mod_row_"+entryCheckbox.value);
     tableBody = $("#Entry_table tbody");
       tableBody.append("<tr id=remove-added-row-"+entryCheckbox.value+"><td>"+table_row.cells[0].innerHTML+"</td><td>"+table_row.cells[1].innerHTML+"</td><td>"+table_row.cells[2].innerHTML+"</td><td>"+table_row.cells[3].innerHTML+"</td><td>"+table_row.cells[4].innerHTML+"</td><td><a class='btn btn-warning' id="+entryCheckbox.value+" onclick='DeleteEntry(this.id)' style='color:black'><i class='fa fa-trash fa-lg' style='text-align:cenetr;'></i></a></td></tr>");
    }
    else {
      $('#EntryModal').modal();
    }
  }
</script>
<script>
  function AddEntryType()
  {
     $('#EntryModal').modal('hide');
      var x = document.getElementById('EntryDIV');
    x.style.display = "block";
  }
  function DeleteEntry(foodCheckbox)
  {
    console.log(foodCheckbox);
     document.getElementById("customSwitch_entry"+foodCheckbox).checked = false;
    $('#remove-added-row-'+foodCheckbox).remove();

  }
  function DeleteFood(foodCheckbox)
  {
    console.log(foodCheckbox);
    document.getElementById("customSwitch"+foodCheckbox).checked = false;
    $('#remove-added-row-food'+foodCheckbox).remove(); 
  }
</script>
@endsection
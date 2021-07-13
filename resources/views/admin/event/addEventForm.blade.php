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


      	<div class="col-md-6 form-group ">
      		<label class="names">Event Description&nbsp;<span style="color:red">*</span></label>
          <input type="text" class="form-control"  name="eventDescription" required="">
      	</div>
      </div>
      <div class="row">
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


        <div class="col-md-6 form-group ">
          <label class="names">Venue&nbsp;<span style="color:red">*</span></label>
          <input class="form-control" type="text" name="eventLocation" required="">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 form-group ">
          <label class="names">Date&nbsp;<span style="color:red">*</span></label>
          <input class="form-control" type="date" name="eventDate" id="eventDate" required="">
        </div>
 <div class="form-group col-md-6">
          <label class="names">Time&nbsp;<span style="color:red">*</span></label>
            <input class="form-control" type="time" name="eventTime" id="eventTime">
        </div>

      </div>
      <div class="row">
       <div class="form-group col-md-6">
          <label class="names">Location Link</label>
            <input class="form-control" type="text" name="eventLocationLink">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12"> 
          <!-- radio -->
                <!-- checkbox -->
              <div class="form-group">
                <label class="col-md-3">
                  <input type="checkbox" class="minimal" onclick="getEntryforms()" id="EntryCheck" name="EntryCheck">&nbsp;&nbsp;Entry Ticket 
                </label>
                <label class="col-md-3">
                  <input type="checkbox" class="minimal" onclick="getFoodforms()" id="FoodCheck" name="FoodCheck">&nbsp;&nbsp;Food Ticket
                </label>
                 <label class="col-md-3">
                  <input type="checkbox" class="minimal" name="competitionCheck" onclick="getFoodforms()" id="CompetitionCheck">&nbsp;&nbsp;Competition
                </label>
              </div>
              <div id="EntryDIV" style="display:none">
              <div class="card-header"><center><strong>Add Event Entry Ticket</strong></center></div>
              <br>
            

        <div class="col-md-12">
          <div class="row">


        <div class="col-md-6 form-group ">
          <label class="names">Age Group</label>
          <select class="form-control" name="ageGroup" id="sel1">
            <option value="">Select</option>
            <option value="kids">Kids</option>
            <option value="Adult">Adult</option>
          </select>
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Member</label>
          <select class="form-control" name="memberType" id="sel1">
            <option value="">Select</option>
            <option value="Member">Member</option>
             <option value="NonMember">NonMember</option>
          </select>
        </div>
         <div class="col-md-6 form-group ">
          <label class="number_of_tickets">Number of Tickets:</label>
          <input class="form-control" type="number" name="number_of_tickets" id="sel1" >
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Price ($):</label>
          <input class="form-control" type="text" name="ticketPrice" id="sel1" >
        </div>

      </div>
        
    </div>
  </div>
    <div id="FoodDIV" style="display:none">
       <div class="card-header"><center><strong>Event Food Ticket</strong></center></div>
       <br>
        <div class="col-md-12">
          <div class="row">
    
        <div class="col-md-6 form-group ">
          <label class="names">Age Group</label>
          <select class="form-control" name="FoodageGroup" id="sel1">
            <option value="">Select</option>
            <option value="kids">Kids</option>
            <option value="Adult">Adult</option>
          </select>
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Member</label>
          <select class="form-control" name="FoodmemberType" id="sel1">
            <option value="">Select</option>
            <option value="Member">Member</option>
             <option value="NonMember">NonMember</option>
          </select>
        </div>
        <div class="col-md-6 form-group ">
          <label class="names">Food</label>
          <select class="form-control" name="foodType" id="sel1">
            <option value="">Select</option>
            <option value="veg">Veg</option>
            <option value="nveg">Non-VEg</option>
            <option value="no-food">No Food</option>
          </select>
        </div>
        <div class="col-md-6 form-group ">
          <label class="Food_number_of_tickets">Number of Tickets:</label>
          <input class="form-control" type="number" name="Food_number_of_tickets" id="sel1" >
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Price</label>
          <input class="form-control" type="text" name="FoodticketPrice" id="sel1" >
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
  console.log(checkBox);
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
  var x = document.getElementById('FoodDIV');
  if (checkBox.checked == true) {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
  }
}
</script>


@endsection
@extends('layouts.user')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-1">


</div>
<!-- /.col -->
<div class="col-md-9">
  <div class="card panel-default">
     @if(Session::has('success'))
     <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get('success')}}
    </div>
    @elseif(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get('warning')}}
    </div>

    @endif

    <div class="card-body">

        <form method="post" action="{{ url('editProfilePost') }}" enctype="multipart/form-data">
          {{ csrf_field() }}

          <input type="hidden" name="email" value="{{ $member['primaryEmail'] }}">
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label>First Name<span style="color:red">*</span><br></label>
                  <input type="text" class="form-control" name="firstName" value="{{ $member['firstName'] }}" placeholder="First Name" required autofocus>
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Last Name<span style="color:red">*</span><br></label>
              <input type="text" class="form-control" name="lastName" value="{{ $member['lastName'] }}" placeholder="Last Name" required autofocus>
          </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>Email<span style="color:red">*</span><br></label>
            <input id="email" type="email" class="form-control"  value="{{ $member['Email_Id'] }}" placeholder="Primary Email" required>
        </div>
    </div>
    <div class="col-md-6">
       <div class="form-group">
          <label>Mobile No<span style="color:red">*</span><br></label>
          <input id="mobile" type="number" class="form-control" name="mobile" value="{{ $member['mobile_number'] }}"  maxlength="10"  placeholder="Mobile No" required>
      </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Gender<span style="color:red">*</span><br></label>
      <select class="form-control" id="gender" name="gender" required>
        <option value="">Gender</option> 
        <option value="male" {{ ($member['gender']  == "male") ? 'selected' : '' }}>Male</option>
        <option value="female" {{ ($member['gender'] == "female") ? 'selected' : '' }}>Female</option>
    </select>
</div>
</div>
<?php
$date =  Carbon\Carbon::now();
$dates = $date->toDateString();
?>

<div class="col-md-6">
   <div class="form-group">
      <label class="control-label" for="dob">DOB&nbsp;<span style="color:red">*</span></label>
      <input type="date" class="form-control"  name="dob" value="{{$member['dob']}}" max="{{$dates}}" required>

  </div>

</div>

<div class="col-md-6">
    <div class="form-group">
      <label>Marital Status<span style="color:red">*</span><br></label>
      <select name="marital" id="maritalStatus" class="form-control" required>
        <option value="">Marital Status</option>
        <option value="single" {{ ($member['maritalStatus'] == "single") ? 'selected' : '' }}>Single</option> 
        <option value="married" {{ ($member['maritalStatus'] == "married") ? 'selected' : '' }}>Married</option>
    </select>
</div>
</div>
<div class="col-md-6">
    <div class="form-group">
      <label>Address 1<span style="color:red">*</span><br></label>
      <input id="zip" type="text" style="border-radius: 4px" class="form-control" name="address1" value="{{ $member['addressLine1'] }}" required>

  </div>
</div>
<div class="col-md-6">
    <div class="form-group">
      <label>Address 2</label>
      <input id="zip" type="text" style="border-radius: 4px" class="form-control"  name="address2" value="{{ $member['addressLine2'] }}" >

  </div>
</div>
        <!---<div class="col-md-4">
          <div class="form-group">
              <label>Address 2<span style="color:red">*</span><br></label>
               <input id="zip" type="text" style="border-radius: 4px" class="form-control" maxlength="5" name="address2" value="{{ $member['addressLine2'] }}">
          </div>
      </div>--->
      <div class="col-md-6">
          <div class="form-group">
            <label>City<span style="color:red">*</span><br></label>
            <input id="city" style="border-radius: 4px" type="text" class="form-control" name="city" value="{{ $member['country'] }}" required>
        </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>State<span style="color:red">*</span><br></label>
        <input id="state" style="border-radius: 4px" type="text" class="form-control" name="state" value="{{ $member['state'] }}" required>

    </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Zip Code<span style="color:red">*</span><br></label>
    <input id="zipcodes" type="text" style="border-radius: 4px" class="form-control" maxlength="7" name="zipCode" value="{{ $member['zipCode'] }}" required>
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    @if($member['profile']=="icon-5359553_1280.webp")
    <label>Upload Member Image</label>
 <div class="input-group">
              <div class="custom-file">
              
                <input type="file" class="custom-file-input" name="profile" id="exampleInputFile" onchange="showname()">
               
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>

        </div>
         @else
          <label>Upload Member Image&nbsp;<br></label>
        <div class="input-group">
              <div class="custom-file">
              
                
                 <input type="file" class="custom-file-input" name="profile" id="exampleInputFile" onchange="showname()">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>

        </div>@endif
         <div id="editor"></div>
</div>
</div>
</div>



<div style="max-width: 200px; margin: auto;">
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/memberTickets" class="btn btn-warning">Cancel</a>

</div><br>
</form>
</div>

</div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
</div>
<script>
  function showname () {
    var name = document.getElementById('exampleInputFile'); 
    document.getElementById('editor').appendChild(document.createTextNode( name.files.item(0).name));
};
</script>
<script type="text/javascript">
  $(document).ready(function () {

    $("#dobDate").keypress(function (e) {
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $("#errmsgDate").html("Digits Only").show().fadeOut("slow");
          return false;
      }
  });

    $("#dobMonth").keypress(function (e) {
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $("#errmsgMonth").html("Digits Only").show().fadeOut("slow");
          return false;
      }
  });


  // $("#dobDate").on('change',function () {
  // var date = $("#dobDate").val();
  //     if (date > 31) {
  //         $("#dobDate").val(31)
  //         return false;
  //     }
  // });

  // $("#dobMonth").on('change',function () {
  // var date = $("#dobMonth").val();
  //     if (date > 12) {
  //         $("#dobMonth").val(12)
  //         return false;
  //     }
  // });



});
</script>
@if(Auth::user()->job_title=='Admin')
<script language="javascript">
  $(document).ready(function()
  { 
     $(document).bind("contextmenu",function(e){
        return false;
    }); 
 })
</script>
@endif
<script language="javascript">
  $(document).ready(function(){
    $("#dobDate").focus(function(){
      $("#day").hide();
  });

    $("#dobMonth").focus(function(){
      $("#month").hide();
  });

    $("#state").focus(function(){
      $("#state1").hide();
  });

    $("#gender").focus(function(){
      $("#gender1").hide();
  });

    $("#maritalStatus").focus(function(){
      $("#maritalStatus1").hide();
  });
});
</script>
@endsection
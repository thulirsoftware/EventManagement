@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">     <div class="row">
        <div class="col-md-11 col-md-offset-2">
            <div class="card">
              <div class="card-header"><center><strong>Update Membership</strong></center></div>
              <div class="card-body">

  <form method="post" action="">
    <div class="col-md-6">
      <div class="input-group col-md-offset-6 col-md-6">
          First Name:<input id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	Date of Birth:
          <input id="date" type="date" class="form-control" name="dob" placeholder="Date of Birth">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	Secondary Email:
          <input id="semail" type="text" class="form-control" name="semail" placeholder="Secondary Email / Spouse Email">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	Address line 1:
          <input id="address1" type="text" class="form-control" name="address1" placeholder="Address Line 1">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	State:
          <input id="state" type="text" class="form-control" name="state" placeholder="state">
      </div>
    </div>

    <div class="col-md-6">
      <div class="input-group col-md-6">
      	Last Name:
          <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Last Name">
      </div>
      <div class="input-group col-md-6">
      	Email:
          <input id="email" type="text" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="input-group col-md-6">
      	Mobile No:
          <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Mobile">
      </div>
      
      <div class="input-group col-md-6">
      	Address Line 2:
          <input id="address2" type="text" class="form-control" name="address2" placeholder="Address Line 2">
      </div>
      <div class="input-group col-md-6">
      	Zip:
          <input id="zip" type="text" class="form-control" name="zip" placeholder="ZIP Code">
      </div>
      <!-- <button type="button" id="formButton1">Individual</button>
      <button type="button" id="formButton2">Family</button> -->
    </div>

    <div class="col-md-12 bottom" style="padding-bottom:25px">
        <center>
        	<input type="submit" name="submit" value="Update" style="background-color: brown;color:yellow;padding:8px">
        	<a href="{{ URL::previous() }}" class="btn btn-warning" style="margin-left: 50px;background-color: brown;color:yellow">Cancel</a>	
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
@endsection
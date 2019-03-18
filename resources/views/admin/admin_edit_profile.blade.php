@extends('layouts.admin')

@section('content')

<style>
.col-md-6{
	margin-top:20px;
}
.bottom
{
	margin-top:20px;
}
p{
	font-size: 25px;
	color:brown;
}
</style>

<div class="col-md-offset-1 col-md-12">
<center><p>Edit Profile</p></center>
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

    <div class="col-md-12 bottom">
        <center>
        	<input type="submit" name="submit" value="Update" style="background-color: brown;color:yellow;padding:8px">
        	<a href="{{ URL::previous() }}" class="btn btn-info" style="margin-left: 50px;background-color: brown;color:yellow">Cancel</a>	
        </center>
    </div>
  </form>

</div>


@endsection
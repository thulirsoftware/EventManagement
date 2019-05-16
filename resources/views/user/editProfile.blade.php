@extends('layouts.user')

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

<div class="col-md-offset-3 col-md-8" style="background-color:#f3f4c6">
<center><p style="padding-top:25px">Edit Profile</p></center>
 

  <form method="post" action="{{ url('editProfilePost') }}">
    {{ csrf_field() }}

    <input type="hidden" name="email" value="{{ $member['primaryEmail'] }}">

    <div class="col-md-6">
     {{--  <div class="input-group col-md-offset-6 col-md-6">
          First Name:
          <input style="border-radius: 4px" type="text" class="form-control" name="firstName" value="{{ $member['firstName'] }}">
      </div>
 --}}
      <div class="input-group col-md-offset-6 col-md-6">
        Mobile No:
          <input id="mobile" style="border-radius: 4px" type="text" class="form-control" name="mobile" value="{{ $member['phoneNo1'] }}">
      </div>

      <div class="input-group col-md-offset-6 col-md-6">
          Gender:<br>
          <select name="gender" style="width:190px;height: 30px;border-radius: 4px;background-color: white;">
            <option value="male" {{ ( $member['gender'] == "male" ) ? 'selected' : '' }}>Male</option>
            <option value="female" {{ ( $member['gender'] == "female" ) ? 'selected' : '' }}>Female</option>
          </select>
      </div>

      <div class="input-group col-md-offset-6 col-md-6">
      	Address:
          <textarea name="address1" style="border-radius: 4px" class="form-control" value="{{ $member['addressLine1'] }}">{{ $member['addressLine1'] }}</textarea>
      </div>

      {{-- <div class="input-group col-md-offset-6 col-md-6">
      	Country:
          <input id="country" type="text" style="border-radius: 4px" class="form-control" name="country" value="{{ $member['country'] }}">
      </div> --}}

      <div class="input-group col-md-offset-6 col-md-6">
        State:
          <input id="state" style="border-radius: 4px" type="text" class="form-control" name="state" value="{{ $member['state'] }}">
      </div>

    </div>



    <div class="col-md-6">
      {{-- <div class="input-group col-md-6">
      	Last Name:
          <input id="lastname" type="text" style="border-radius: 4px" class="form-control" name="lastName" value="{{ $member['lastName'] }}">
      </div> --}}

      <div class="input-group col-md-6">
        Date of Birth:
          <input id="date" style="border-radius: 4px" type="date" class="form-control" name="dob" value="{{ $member['dob'] }}">
      </div>

      <div class="input-group  col-md-6">
          Marital status:<br>
          <select name="marital" style="width:190px;height: 30px;border-radius: 4px;background-color: white;">
            <option value="single" {{ ($member['maritalStatus'] == 'single')?'selected':'' }}>Single</option>
            <option value="married" {{ ( $member['maritalStatus'] == "married" ) ? 'selected' : '' }}>Married</option>
          </select>
      </div>

      <div class="input-group col-md-6">
        Address line 2:
          <textarea name="address2" style="border-radius: 4px" class="form-control" value="{{ $member['addressLine2'] }}">{{ $member['addressLine2'] }}</textarea>
      </div>

      

      <div class="input-group col-md-6">
        Zip Code:
          <input id="zip" type="text" style="border-radius: 4px" class="form-control" name="zipCode" value="{{ $member['zipCode'] }}">
      </div> 
      
    </div>



    <div class="col-md-12 bottom" style="padding-bottom:25px">
        <center>
        	<input type="submit" name="submit" value="Update" style="background-color: brown;color:yellow;padding:8px">
        	<a href="{{ url("user_home") }}" class="btn btn-info" style="margin-left: 50px;background-color: brown;color:yellow">Cancel</a>	
        </center>
    </div>
  </form>

</div>



@endsection
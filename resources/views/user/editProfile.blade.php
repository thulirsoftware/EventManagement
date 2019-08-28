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

    
     {{--  <div class="input-group col-md-offset-6 col-md-6">
          First Name:
          <input style="border-radius: 4px" type="text" class="form-control" name="firstName" value="{{ $member['firstName'] }}">
      </div>
 --}}
      <div class="input-group col-md-offset-2 col-md-9">
        <div class="col-md-3" style="padding-top:5px">Mobile No:</div>
           <div class="col-md-7"><input id="mobile" maxlength="10" style="border-radius: 4px" type="text" class="form-control" name="mobile" value="{{ $member['phoneNo1'] }}"></div>
      </div>

      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
          <div class="col-md-3" style="padding-top:5px">Gender:</div>
          
            {{-- <select id="gender" name="gender" style="width:190px;height: 30px;border-radius: 4px;background-color: white;">
            <option id="gender1" value="{{$member['gender']}}">{{$member['gender']}}</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select> --}}
          

      <div class="col-md-7">
        <select class="form-control" id="gender" name="gender" style="width:155px">
          <option id="gender1" value="{{ $member['gender'] }}">{{ $member['gender'] }}</option><option value="Male">Male</option><option value="Female">Female</option>
        </select><span style="color: red" id="errmsgDate">
          </span></div>
      </div>
     


       <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
        <div class="col-md-3" style="padding-top:5px">DOB - Birth Day:</div>
          <div class="col-md-7">{{-- <input id="dobDate" style="border-radius: 4px" type="text" class="form-control" name="dobDate" value="{{ $member['day'] }}" maxlength="2" required=""><span style="color: red" id="errmsgDate"> --}}
        <select class="form-control" id="dobDate" name="dob" style="width:155px">
          <option id="day" value="{{ $member['day'] }}">{{ $member['day'] }}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
        </select><span style="color: red" id="errmsgDate">
          </span></div>
      </div>

      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
       <div class="col-md-3" style="padding-top:5px"> DOB - Birth Month:</div>
          <div class="col-md-7">{{-- <input id="dobMonth" style="border-radius: 4px" type="text" class="form-control" name="dobMonth" value="{{ $member['month'] }}" maxlength="2" required=""> --}}
          <select class="form-control" id="dobMonth" name="mob" style="width:155px">
          <option id="month" value="{{ $member['month'] }}">{{ $member['month'] }}</option><option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option><option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option><option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option>
        </select>

            <span style="color: red" id="errmsgMonth"></span></div>
      </div>

      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
          <div class="col-md-3" style="padding-top:5px">Marital status:</div>
          {{-- <div class="col-md-7"><select name="marital" style="width:190px;height: 30px;border-radius: 4px;background-color: white;">
            <option value="single" {{ ($member['maritalStatus'] == 'single')?'selected':'' }}>Single</option>
            <option value="married" {{ ( $member['maritalStatus'] == "married" ) ? 'selected' : '' }}>Married</option>
          </select>
         </div> --}}
      <div class="col-md-7">
        <select class="form-control" id="maritalStatus" name="marital" style="width:155px">
          <option id="maritalStatus1" value="{{ $member['maritalStatus'] }}">{{ $member['maritalStatus'] }}</option><option value="Single">Single</option><option value="Married">Married</option>
        </select><span style="color: red" id="errmsgDate">
          </span>
      </div>
      </div>


      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
      	<div class="col-md-3" style="padding-top:5px">Address Line 1:</div>
        <div class="col-md-7"><textarea name="address1" style="border-radius: 4px" class="form-control" value="{{ $member['addressLine1'] }}">{{ $member['addressLine1'] }}</textarea></div>
      </div>

      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
        <div class="col-md-3" style="padding-top:5px">Address line 2:</div>
          <div class="col-md-7"><textarea name="address2" style="border-radius: 4px" class="form-control" value="{{ $member['addressLine2'] }}">{{ $member['addressLine2'] }}</textarea></div>
      </div>

      {{-- <div class="input-group col-md-offset-6 col-md-6">
      	Country:
          <input id="country" type="text" style="border-radius: 4px" class="form-control" name="country" value="{{ $member['country'] }}">
      </div> --}}


      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
        <div class="col-md-3" style="padding-top:5px">City:</div>
          <div class="col-md-7"><input id="city" style="border-radius: 4px" type="text" class="form-control" name="city" value="{{ $member['country'] }}"></div>
      </div>


      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
        <div class="col-md-3" style="padding-top:5px">State:</div>
          <div class="col-md-7">
            {{-- <input id="state" style="border-radius: 4px" type="text" class="form-control" name="state" value="{{ $member['state'] }}"> --}}
          <select id="state" type="text" class="form-control" name="state" required>
              <option id="state1" value="{{ $member['state'] }}">{{ $member['state'] }}</option><option value="Alabama">Alabama</option>
              <option value="">Select State</option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky[E]">Kentucky[E]</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts[E]">Massachusetts[E]</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania[E]">Pennsylvania[E]</option><option value="Rhode Island[F]>Rhode Island[F]</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value=" Vermont"> Vermont</option><option value="Virginia[E]">Virginia[E]</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option>
                  </select>
          </div>
      </div>


      

   



    
      {{-- <div class="input-group col-md-6">
      	Last Name:
          <input id="lastname" type="text" style="border-radius: 4px" class="form-control" name="lastName" value="{{ $member['lastName'] }}">
      </div> --}}

      {{-- <div class="input-group col-md-6">
        Date of Birth:
          <input id="date" style="border-radius: 4px" type="date" class="form-control" name="dob" value="{{ $member['dob'] }}">
      </div> --}}



      

      <div class="input-group col-md-offset-2 col-md-9" style="padding-top: 10px">
        <div class="col-md-3" style="padding-top:5px">Zip Code:</div>
          <div class="col-md-7"><input id="zip" type="text" style="border-radius: 4px" class="form-control" maxlength="5" name="zipCode" value="{{ $member['zipCode'] }}"></div>
      </div> 
      
   



    <div class="col-md-12 bottom" style="padding-bottom:25px">
        <center>
        	<input type="submit" name="submit" value="Update" style="background-color: brown;color:yellow;padding:8px">
        	<a href="{{ url("memberTickets") }}" class="btn btn-info" style="margin-left: 50px;background-color: brown;color:yellow">Cancel</a>	
        </center>
    </div>
  </form>

</div>

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
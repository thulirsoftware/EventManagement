@extends('layouts.app')

@section('content')


<div class="container"> 

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel">
                <div class="panel-heading" style="background-color:brown;color:white;font-size:20px">Register</div>
                <div class="panel-body "style="background-color:#f3f4c6">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
    <input type="hidden" class="form-control" name="userType" value="user">


        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="col-md-6" style="margin-top: 22px">
          <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="First Name" required autofocus>
                <span class="input-group-addon" style="background-color:brown"><i style="color:white" class="glyphicon glyphicon-user"></i></span>
            </div>
          </div>
        </div>


        <div class="col-md-6 form-group" style="margin-top: 22px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>
            </div>
        </div>
        </div>





    <div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <input id="phoneNo1" type="text" class="form-control" name="phoneNo1" placeholder="Phone No" max="10" maxlength="10" value="{{ old('phoneNo1') }}" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span>
                <span style="color: red" id="errmsg"></span>
            </div>
        </div>
    </div>




        <div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <select name="gender" id="gender" class="selectpicker form-control" required="">
                    <option value="">Gender</option> 
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>
            </div>
        </div>
    </div>
        
        <div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <select name="maritalStatus" id="maritalStatus" class="selectpicker form-control" required>
                    <option value="">Marital Status</option>
                    <option value="single">Single</option> 
                    <option value="married">Married</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>
    </div>

<div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                
                <select id="dobDate" type="text" class="form-control" name="dob" class="form-control" id="sel1"  value="{{ old('dob') }}"  required>
                    <option value="">Date of Birth</option>
                    <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span><span style="color: red" id="errmsgDate"></span>
               
            </div>
        </div>
    </div>

        <div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                
                <select id="dobMonth" type="text" class="form-control" name="mob" value="{{ old('mob') }}" required>
                    <option>Month of Birth</option><option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option>
                    <option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option>
                    <option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option>
                  </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span><span style="color: red" id="errmsgMonth"></span>
            </div>
        </div>
    </div>


<div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <textarea id="address1" class="form-control" name="address1" placeholder="Address 1" value="{{ old('address1') }}" required></textarea>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

       </div>
   </div>
</div>
<div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <textarea id="address2" class="form-control" name="address2" placeholder="Address 2" value="{{ old('address2') }}"></textarea>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>
        </div>
</div>
</div>
              

        <div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="city" type="text" class="form-control" name="city" placeholder="Enter City Name" value="{{ old('city') }}" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>
    </div>

        <div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <select id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required>
                    <option value="">Select State</option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Rhode Island>Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value=" Vermont"> Vermont</option><option value="Virginia">Virginia</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option>
                  </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>
    </div>

        <div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="zipCode" type="text" class="form-control" name="zipCode" placeholder="Zip Code" value="{{ old('zipCode') }}" maxlength="5" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-map-marker"></i></span><span id="errmsgZip"></span>

             
            </div>
        </div>
    </div>



<div class="family col-md-12" style="display: none">
    <div class="col-md-6" style="margin-top: 15px;margin-left:0px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="spouseFName" type="text" class="form-control" name="spouseFName" placeholder="Spouse First Name" value="{{ old('spouseFName') }}" style="width:200px;margin-left: -11px">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>
    </div>
<div class="col-md-6 form-group" style="margin-top: 15px;margin-left:-15px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <input id="spouseLName" type="text" class="form-control" name="spouseLName" maxlength="10" placeholder="Spouse Last Name" value="{{ old('spouseLName') }}" style="width:200px;margin-left: 0px">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                <span style="color: red" id="errmssg"></span>

            </div>
        </div>
    </div>
    
    
    <div class="col-md-6" style="margin-top: -10px;margin-left:-10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="spousePhoneNo" type="text" class="form-control" name="spousePhoneNo" maxlength="10" placeholder="Spouse Phone Number" value="{{ old('spousePhoneNo') }}" style="width:200px;margin-left: 0px">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-earphone"></i></span>

            </div>
        </div>
    </div>
<div class="col-md-6 form-group" style="margin-top: -10px;margin-left:-15px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <input id="" type="text" class="form-control" name="" maxlength="10" placeholder="Spouse Phone Number" value="{{ old('') }}" style="width:200px;mrgin-left: 0px;display:none">
                <span style="background-color:#f3f4c6;border:none" class="input-group-addon"><i style="color:#f3f4c6" class="glyphicon glyphicon-earphone"></i></span>

                <span style="color: red" id="errmssg"></span>

            </div>
        </div>
    </div>
    
    
    
    
    


        <?php 
          $schools = App\School::pluck('name');
        ?>

        
        <div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="firstChildName" type="text" class="form-control" name="firstChildName" value="{{ old('firstChildName') }}" placeholder="Child1 Name" style="width:200px;margin-left: -10px">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

             </div> 
            </div>
        </div>

        <div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <select name="child1SchoolName" id="child1SchoolName" style="width: 200px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">Tamil School</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

               
            </div>
        </div>
    </div>



        <div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="secondChildName" type="text" class="form-control" name="secondChildName" placeholder="Child2 Name" value="{{ old('secondChildName') }}" style="width:200px;margin-left: -10px">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

              </div>
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                <select name="child2SchoolName" id="child2SchoolName" style="width: 200px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">Tamil School</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

            </div>
        </div>
    </div>
    
    
    


        <div class="col-md-6" style="margin-top: -10px">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="thirdChildName" type="text" class="form-control" name="thirdChildName" value="{{ old('thirdChildName') }}" placeholder="Child3 Name" style="width:200px;margin-left: -10px">
                
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>
    </div>

         <div class="col-md-6 form-group" style="margin-top: -10px">
          <div class="form-group row">
            <div class="input-group col-md-8">
                
                <select name="child3SchoolName" id="child3SchoolName" style="width: 200px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">Tamil School</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>


                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

            </div>
        </div>
</div>

        <div class="col-md-6" style="margin-top: -10px;display:none">
        <div class="form-group row">
            <div class="input-group col-md-offset-3 col-md-8">
                <input id="" type="text" class="form-control" name="" value="{{ old('') }}" placeholder="Child3 Name" style="width:200px;margin-left: -10px">
                
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>
    </div>

         <div class="col-md-6 form-group" style="margin-top: -10px;display:none">
          <div class="form-group row">
            <div class="input-group col-md-8">
                
                <select name="" id="" style="width: 200px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>


                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

            </div>
        </div>
</div>



</div>


        
        <div class="col-md-9 form-group"  style="margin-left: 14px">
            
            <div class="input-group col-md-offset-5 col-md-6 ">
                <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>

               
            </div>
        </div>
        <div class="col-md-9 form-group" style="margin-left: 14px">
            <div class="input-group col-md-offset-5 col-md-6 ">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Password" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>
        <div class="form-group" style="padding-bottom:20px;padding-left:10px">
        <div class="col-md-6 col-md-offset-5" >
            <button type="submit" class="btn btn-lg btn-primary">
                Register
            </button>
        </div>
    </div>
                    </form>
</div>

    
    </div>
    </div>

        




       




     {{--    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
           
            <div class="input-group col-md-8">
                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" placeholder="Date Of Birth" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-calendar"></i></span>
                @if ($errors->has('dob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dob') }}</strong>
                    </span>
                @endif
            </div>
        </div> --}}


         

        



{{-- <div class="family" style="display: none">
        



        

        

       
</div>

        


        

    </div>

    
                </div>
            </div>
        </div>
    </div>
</div>

 --}}


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> 


<script type="text/javascript">
    $(document).ready(function() {
        $('#maritalStatus').on('change', function() {
        var maritalStatus = $(this).val();
        if(maritalStatus=="married"){
            $('.family').show();
        }else{
            $('.family').hide();
        }
     });
});
</script>

<script type="text/javascript">
  $(document).ready(function () {

  $("#phoneNo1").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });


  $("#spousePhoneNo").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmssg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

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

  $("#zipCode").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsgZip").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

    $("#dobDate").on('change',function () {
    var date = $("#dobDate").val();
        if (date > 31) {
            $("#dobDate").val(31)
            return false;
        }
    });

    $("#dobMonth").on('change',function () {
    var date = $("#dobMonth").val();
        if (date > 12) {
            $("#dobMonth").val(12)
            return false;
        }
    });

});
</script>

@endsection




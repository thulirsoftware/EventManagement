@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel">
                <div class="panel-heading" style="background-color:brown;color:white">Register</div>
                <div class="panel-body "style="background-color:#f3f4c6">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
    <input type="hidden" class="form-control" name="userType" value="user">

    <div class="col-md-6" style="padding-top:40px;margin-left:24px">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="First Name" required autofocus>
                <span class="input-group-addon" style="background-color:brown"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('name'))http://tagdv.iyarkaimaruthuvam.in/register
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            </div>
        </div>


         <div class="col-md-6 form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
          
            <div class="input-group col-md-8" style="padding-top:40px">
                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('lastName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastName') }}</strong>
                    </span>
                @endif
            </div>
        </div>





        <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-left:14px">

            <div class="input-group col-md-offset-3 col-md-9">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('phoneNo1') ? ' has-error' : '' }}" style="margin-left: -20px">
           
            <div class="input-group col-md-offset-1 col-md-8">
                <input id="phoneNo1" type="text" class="form-control" name="phoneNo1" placeholder="Phone No" max="10" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span>
                <span style="color: red" id="errmsg"></span>

                @if ($errors->has('phoneNo1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phoneNo1') }}</strong>
                    </span>
                @endif
            </div>
        </div>




        <div class="col-md-6 form-group{{ $errors->has('gender') ? ' has-error' : '' }}" style="margin-left:14px">

            <div class="input-group col-md-offset-3 col-md-9">
                <select name="gender" id="gender" class="selectpicker form-control" required="">
                    <option value="">Gender</option> 
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('gender'))
                    <span class="help-block">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="col-md-6 form-group{{ $errors->has('maritalStaus') ? ' has-error' : '' }}" style="margin-left:-20px">
           
            <div class="input-group col-md-offset-1 col-md-8">
                <select name="maritalStatus" id="maritalStatus" class="selectpicker form-control" required="">
                    <option value="">Marital Status</option>
                    <option value="single">Single</option> 
                    <option value="married">Married</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('maritalStaus'))
                    <span class="help-block">
                        <strong>{{ $errors->first('maritalStaus') }}</strong>
                    </span>
                @endif
            </div>
        </div>

<div class="col-md-6 form-group{{ $errors->has('dobDate') ? ' has-error' : '' }}" style="margin-left:14px">
           
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="dobDate" type="text" class="form-control" name="dobDate" placeholder="DOB Date in DD Format" maxlength="2" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span><span style="color: red" id="errmsgDate"></span>
                @if ($errors->has('dobDate'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dobDate') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 form-group{{ $errors->has('dobMonth') ? ' has-error' : '' }}" style="margin-left: -20px">
           
            <div class="input-group col-md-offset-1 col-md-8">
                <input id="dobMonth" type="text" class="form-control" name="dobMonth" placeholder="DOB Month in MM Format" maxlength="2" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span><span style="color: red" id="errmsgMonth"></span>

                @if ($errors->has('dobMonth'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dobMonth') }}</strong>
                    </span>
                @endif
            </div>
        </div>


<div class="col-md-6 form-group{{ $errors->has('address1') ? ' has-error' : '' }}" style="margin-left:14px">

            <div class="input-group col-md-offset-3 col-md-9">
                <input id="address1" type="text" class="form-control" name="address1" placeholder="Address" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('address1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address1') }}</strong>
                    </span>
                @endif
       </div>
</div>
<div class=" col-md-6 form-group{{ $errors->has('address2') ? ' has-error' : '' }}" style="margin-left:-20px">

            <div class="input-group  col-md-offset-1 col-md-8">
                <input id="address2" type="text" class="form-control" name="address2" placeholder="Address" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('address2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address2') }}</strong>
                    </span>
                @endif
        </div>
</div>



<div class="family" style="display: none">
        <div class="col-md-6 form-group{{ $errors->has('spouseName') ? ' has-error' : '' }}">

            <div class="input-group col-md-offset-4 col-md-9">
                <input id="spouseName" type="text" class="form-control" name="spouseName" placeholder="Spouse First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('spouseName'))
                    <span class="help-block">http://tagdv.iyarkaimaruthuvam.in/register
                        <strong>{{ $errors->first('spouseName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
<div class="col-md-6 form-group{{ $errors->has('spousePhoneNo') ? ' has-error' : '' }}">
           
            <div class="input-group col-md-offset-2 col-md-8">
                <input id="spousePhoneNo" type="text" class="form-control" name="spousePhoneNo" placeholder="Spouse Phone Number">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-earphone"></i></span>

                <span style="color: red" id="errmssg"></span>

                @if ($errors->has('spousePhoneNo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('spousePhoneNo') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <?php 
          $schools = App\School::pluck('name');
        ?>

        
        <div class="col-md-6 form-group{{ $errors->has('firstChildName') ? ' has-error' : '' }}">

            <div class="input-group col-md-offset-4 col-md-9">
                <input id="firstChildName" type="text" class="form-control" name="firstChildName" placeholder="Child1 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('firstChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 form-group{{ $errors->has('child1SchoolName') ? ' has-error' : '' }}">
           
            <div class="input-group col-md-offset-2 col-md-8">
              
                <select name="child1SchoolName" id="child1SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('child1SchoolName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('child1SchoolName') }}</strong>
                    </span>
                @endif
            </div>
        </div>



        <div class="col-md-6 form-group{{ $errors->has('secondChildName') ? ' has-error' : '' }}" style="margin-left: -260px">
           
            <div class="input-group col-md-offset-1 col-md-9">
                <input id="secondChildName" type="text" class="form-control" name="secondChildName" placeholder="Child2 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('secondChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('SecondChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('child2SchoolName') ? ' has-error' : '' }}" style="margin-left: -100px">
         
            <div class="input-group col-md-offset-2 col-md-8">
               
                <select name="child2SchoolName" id="child2SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('child2SchoolName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('child2SchoolName') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="col-md-6 form-group{{ $errors->has('thirdChildName') ? ' has-error' : '' }}" style="margin-left: 14px">
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="thirdChildName" type="text" class="form-control" name="thirdChildName" placeholder="Child3 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('thirdChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('thirdChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

         <div class="col-md-6 form-group{{ $errors->has('child3SchoolName') ? ' has-error' : '' }}">
           
            <div class="input-group col-md-offset-1 col-md-8">
                
                <select name="child3SchoolName" id="child3SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>


                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('child3SchoolName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('child3SchoolName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
</div>








        <div class="col-md-9 form-group" style="margin-left: 14px;">
           
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="state" type="text" class="form-control" name="state" placeholder="Enter State Name" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>

        <div class="col-md-9 form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}"  style="margin-left: 14px">

            <div class="input-group col-md-offset-3 col-md-9">
                <input id="zipCode" type="text" class="form-control" name="zipCode" placeholder="Zip Code" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-map-marker"></i></span>

                @if ($errors->has('zipCode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zipCode') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-9 form-group{{ $errors->has('password') ? ' has-error' : '' }}"  style="margin-left: 14px">
            
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-9 form-group" style="margin-left: 14px">
            <div class="input-group col-md-offset-3 col-md-9">
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

});
</script>

@endsection




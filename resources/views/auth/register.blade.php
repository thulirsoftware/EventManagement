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


    <div class="col-md-6" style="padding-top:40px;margin-left:24px">
        <div class="form-group">

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="First Name" required autofocus>
                <span class="input-group-addon" style="background-color:brown"><i style="color:white" class="glyphicon glyphicon-user"></i></span>
            </div>
            </div>
        </div>


         <div class="col-md-6 form-group">
          
            <div class="input-group col-md-8" style="padding-top:40px">
                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>
            </div>
        </div>





        <div class="col-md-6 form-group" style="margin-left:14px">

            <div class="input-group col-md-offset-3 col-md-9">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-left: -20px">
           
            <div class="input-group col-md-offset-1 col-md-8">
                <input id="phoneNo1" type="text" class="form-control" name="phoneNo1" placeholder="Phone No" max="10" value="{{ old('phoneNo1') }}" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span>
                <span style="color: red" id="errmsg"></span>
            </div>
        </div>




        <div class="col-md-6 form-group" style="margin-left:14px">

            <div class="input-group col-md-offset-3 col-md-9">
                <select name="gender" id="gender" class="selectpicker form-control" required="">
                    <option value="">Gender</option> 
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>
            </div>
        </div>
        
        <div class="col-md-6 form-group" style="margin-left:-20px">
           
            <div class="input-group col-md-offset-1 col-md-8">
                <select name="maritalStatus" id="maritalStatus" class="selectpicker form-control" required="">
                    <option value="">Marital Status</option>
                    <option value="single">Single</option> 
                    <option value="married">Married</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>

<div class="col-md-6 form-group" style="margin-left:14px">
           
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="dobDate" type="text" class="form-control" name="dobDate" placeholder="DOB Date in DD Format" maxlength="2" value="{{ old('dobDate') }}"  required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span><span style="color: red" id="errmsgDate"></span>
               
            </div>
        </div>

        <div class="col-md-6 form-group" style="margin-left: -20px">
           
            <div class="input-group col-md-offset-1 col-md-8">
                <input id="dobMonth" type="text" class="form-control" name="dobMonth" placeholder="DOB Month in MM Format" maxlength="2" value="{{ old('dobMonth') }}" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-phone"></i></span><span style="color: red" id="errmsgMonth"></span>
            </div>
        </div>


<div class="col-md-6 form-group" style="margin-left:14px">

            <div class="input-group col-md-offset-3 col-md-9">
                <textarea id="address1" class="form-control" name="address1" placeholder="Address 1" value="{{ old('address1') }}" required></textarea>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

       </div>
</div>
<div class=" col-md-6 form-group" style="margin-left:-20px">

            <div class="input-group  col-md-offset-1 col-md-8">
                <textarea id="address2" class="form-control" name="address2" placeholder="Address 2" value="{{ old('address2') }}" required></textarea>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>
        </div>
</div>
              

        <div class="col-md-6 form-group" style="margin-left: 14px;">
           
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="city" type="text" class="form-control" name="city" placeholder="Enter City Name" value="{{ old('city') }}" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>

        <div class="col-md-6 form-group" style="margin-left: 7px;">
           
            <div class="input-group col-md-offset-0 col-md-8">
                <input id="state" type="text" class="form-control" name="state" placeholder="Enter State Name" value="{{ old('state') }}" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>

        <div class="col-md-9 form-group "  style="margin-left: 10px;">

            <div class="input-group col-md-offset-2 col-md-6">
                <input id="zipCode" type="text" class="form-control" name="zipCode" placeholder="Zip Code" value="{{ old('zipCode') }}" maxlength="6" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-map-marker"></i></span><span id="errmsgZip"></span>

             
            </div>
        </div>



<div class="family" style="display: none">
        <div class="col-md-6 form-group">

            <div class="input-group col-md-offset-4 col-md-9">
                <input id="spouseName" type="text" class="form-control" name="spouseName" placeholder="Spouse First Name" value="{{ old('spouseName') }}">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>
<div class="col-md-6 form-group">
           
            <div class="input-group col-md-offset-2 col-md-8">
                <input id="spousePhoneNo" type="text" class="form-control" name="spousePhoneNo" placeholder="Spouse Phone Number" value="{{ old('spousePhoneNo') }}">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-earphone"></i></span>

                <span style="color: red" id="errmssg"></span>

            </div>
        </div>


        <?php 
          $schools = App\School::pluck('name');
        ?>

        
        <div class="col-md-6 form-group">

            <div class="input-group col-md-offset-4 col-md-9">
                <input id="firstChildName" type="text" class="form-control" name="firstChildName" value="{{ old('firstChildName') }}" placeholder="Child1 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

              
            </div>
        </div>

        <div class="col-md-6 form-group">
           
            <div class="input-group col-md-offset-2 col-md-8">
              
                <select name="child1SchoolName" id="child1SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

               
            </div>
        </div>



        <div class="col-md-6 form-group" style="margin-left: -260px">
           
            <div class="input-group col-md-offset-1 col-md-9">
                <input id="secondChildName" type="text" class="form-control" name="secondChildName" placeholder="Child2 First Name" value="{{ old('secondChildName') }}">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

              
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-left: -100px">
         
            <div class="input-group col-md-offset-2 col-md-8">
               
                <select name="child2SchoolName" id="child2SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

            </div>
        </div>


        <div class="col-md-6 form-group" style="margin-left: 14px">
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="thirdChildName" type="text" class="form-control" name="thirdChildName" value="{{ old('thirdChildName') }}" placeholder="Child3 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>

         <div class="col-md-6 form-group">
           
            <div class="input-group col-md-offset-1 col-md-8">
                
                <select name="child3SchoolName" id="child3SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>


                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

            </div>
        </div>
</div>


        
        <div class="col-md-9 form-group"  style="margin-left: 14px">
            
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>

               
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

  $("#zipCode").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsgZip").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

});
</script>

@endsection




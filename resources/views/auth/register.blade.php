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

    <div class="col-md-6" style="padding-top:40px">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {{-- <label for="name" class="col-md-4 control-label">Name</label> --}}

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

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
            {{-- <label for="gender" class="col-md-4 control-label">Gender</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
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

         <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
            {{-- <label for="phoneNo1" class="col-md-4 control-label">Address1</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="address1" type="text" class="form-control" name="address1" placeholder="Address" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('address1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address1') }}</strong>
                    </span>
                @endif
            </div>
        </div>

<div class="family" style="display: none">
        <div class="form-group{{ $errors->has('spouseName') ? ' has-error' : '' }}">
            {{-- <label for="spouseName" class="col-md-4 control-label">Spouse Name</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="spouseName" type="text" class="form-control" name="spouseName" placeholder="Spouse First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('spouseName'))
                    <span class="help-block">http://tagdv.iyarkaimaruthuvam.in/register
                        <strong>{{ $errors->first('spouseName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('firstChildName') ? ' has-error' : '' }}">
            {{-- <label for="firstChildName" class="col-md-4 control-label">First Child Name</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="firstChildName" type="text" class="form-control" name="firstChildName" placeholder="Child1 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('firstChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('secondChildName') ? ' has-error' : '' }}">
            {{-- <label for="secondChildName" class="col-md-4 control-label">Second Child Name</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="secondChildName" type="text" class="form-control" name="secondChildName" placeholder="Child2 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('secondChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('SecondChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('thirdChildName') ? ' has-error' : '' }}">
            {{-- <label for="thirdChildName" class="col-md-4 control-label">Third Child Name</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="thirdChildName" type="text" class="form-control" name="thirdChildName" placeholder="Child3 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('thirdChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('thirdChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
</div>

        <div class="form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}">
            {{-- <label for="zipCode" class="col-md-4 control-label">Zip Code</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="zipCode" type="text" class="form-control" name="zipCode" placeholder="Zip Code" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-map-marker"></i></span>

                @if ($errors->has('zipCode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zipCode') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}

            <div class="input-group col-md-offset-3 col-md-8">
                <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

    </div>
                    

    <div class="col-md-6" style="padding-top:40px">
        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
            {{-- <label for="lastName" class="col-md-4 control-label">Last Name</label> --}}

            <div class="input-group col-md-8">
                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('lastName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('phoneNo1') ? ' has-error' : '' }}">
            {{-- <label for="phoneNo1" class="col-md-4 control-label">Phone No1</label> --}}

            <div class="input-group col-md-8">
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

        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
            {{-- <label for="dob" class="col-md-4 control-label">Date Of Birth</label> --}}

            <div class="input-group col-md-8">
                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" placeholder="Date Of Birth" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-calendar"></i></span>
                @if ($errors->has('dob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dob') }}</strong>
                    </span>
                @endif
            </div>
        </div>


         <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">

            <div class="input-group  col-md-8">
                <input id="address2" type="text" class="form-control" name="address2" placeholder="Address" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('address2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address2') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('maritalStaus') ? ' has-error' : '' }}">
            {{-- <label for="maritalStaus" class="col-md-4 control-label">Marital Status</label> --}}

            <div class="input-group col-md-8">
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

<?php 
    $schools = App\School::pluck('name');
?>

<div class="family" style="display: none">
        <div class="form-group{{ $errors->has('spousePhoneNo') ? ' has-error' : '' }}">
            {{-- <label for="spousePhoneNo" class="col-md-4 control-label">Spouse Phone No</label> --}}

            <div class="input-group col-md-8">
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



        <div class="form-group{{ $errors->has('child1SchoolName') ? ' has-error' : '' }}">
            {{-- <label for="child1SchoolName" class="col-md-4 control-label">Child1 School Name</label> --}}

            <div class="input-group col-md-8">
                {{-- <input id="child1SchoolName" type="test" class="form-control" name="child1SchoolName" placeholder="Child1 School Name"> --}}

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

        <div class="form-group{{ $errors->has('child2SchoolName') ? ' has-error' : '' }}">
            {{-- <label for="child2SchoolName" class="col-md-4 control-label">Child2 School Name</label> --}}

            <div class="input-group col-md-8">
                {{-- <input id="child2SchoolName" type="test" class="form-control" name="child2SchoolName" placeholder="Child2 School Name"> --}}

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

        <div class="form-group{{ $errors->has('child3SchoolName') ? ' has-error' : '' }}">
            {{-- <label for="child3SchoolName" class="col-md-4 control-label">Child3 School Name</label> --}}

            <div class="input-group col-md-8">
                {{-- <input id="child3SchoolName" type="test" class="form-control" name="child3SchoolName" placeholder="Child3 School Name"> --}}

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

         {{-- <div class="form-group{{ $errors->has('membershipType') ? ' has-error' : '' }}">

            <div class="input-group col-md-8">
                <select name="membershipType" id="membershipType" class="selectpicker form-control" required="">
                    <option value="">Membership Type</option> 
                    <option value="annual">Annual Membership</option>
                    <option value="lifetime">Lifetime Membership</option>
                </select>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('membershipType'))
                    <span class="help-block">
                        <strong>{{ $errors->first('membershipType') }}</strong>
                    </span>
                @endif
            </div>
        </div> --}}

        <div class="form-group">
           
            <div class="input-group col-md-8">
                <input id="state" type="text" class="form-control" name="state" placeholder="Enter State Name" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>


        <div class="form-group">
            {{-- <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label> --}}

            <div class="input-group col-md-8">
               

                {{-- <input type="text" class="form-control time" id="fdate" placeholder="Select From Date" name="fdate" required> --}}

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Password" required>
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>

    </div>

    <div class="form-group" style="padding-bottom:20px">
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
    </div>
</div>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> 
    
    <script>
        $('.time').datetimepicker({
            format: 'MM/DD',
        });
    </script>





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

});
</script>

@endsection




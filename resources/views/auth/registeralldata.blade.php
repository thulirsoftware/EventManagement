@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                    

    <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {{-- <label for="name" class="col-md-4 control-label">Name</label> --}}

            <div class="input-group col-md-8">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="First Name" required autofocus>
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}

            <div class="input-group col-md-8">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}

            <div class="input-group col-md-8">
                <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
            {{-- <label for="gender" class="col-md-4 control-label">Gender</label> --}}

            <div class="input-group col-md-8">
                <select name="gender" id="gender" class="selectpicker form-control" required="">
                    <option value="">Gender</option> 
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('gender'))
                    <span class="help-block">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('phoneNo1') ? ' has-error' : '' }}">
            {{-- <label for="phoneNo1" class="col-md-4 control-label">Phone No1</label> --}}

            <div class="input-group col-md-8">
                <input id="phoneNo1" type="text" class="form-control" name="phoneNo1" placeholder="Phone No1" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>

                @if ($errors->has('phoneNo1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phoneNo1') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
            {{-- <label for="phoneNo1" class="col-md-4 control-label">Address1</label> --}}

            <div class="input-group col-md-8">
                <input id="address1" type="text" class="form-control" name="address1" placeholder="Address 1" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('address1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address1') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
            {{-- <label for="country" class="col-md-4 control-label">country</label> --}}

            <div class="input-group col-md-8">
                <input id="country" type="text" class="form-control" name="country" placeholder="country" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>

                @if ($errors->has('country'))
                    <span class="help-block">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}">
            {{-- <label for="zipCode" class="col-md-4 control-label">Zip Code</label> --}}

            <div class="input-group col-md-8">
                <input id="zipCode" type="text" class="form-control" name="zipCode" placeholder="Zip Code" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>

                @if ($errors->has('zipCode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zipCode') }}</strong>
                    </span>
                @endif
            </div>
        </div>
<div class="family" style="display: none">
        <div class="form-group{{ $errors->has('spouseName') ? ' has-error' : '' }}">
            {{-- <label for="spouseName" class="col-md-4 control-label">Spouse Name</label> --}}

            <div class="input-group col-md-8">
                <input id="spouseName" type="text" class="form-control" name="spouseName" placeholder="Spouse Name">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('spouseName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('spouseName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('firstChildName') ? ' has-error' : '' }}">
            {{-- <label for="firstChildName" class="col-md-4 control-label">First Child Name</label> --}}

            <div class="input-group col-md-8">
                <input id="firstChildName" type="text" class="form-control" name="firstChildName" placeholder="First Child Name">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('firstChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('secondChildName') ? ' has-error' : '' }}">
            {{-- <label for="secondChildName" class="col-md-4 control-label">Second Child Name</label> --}}

            <div class="input-group col-md-8">
                <input id="secondChildName" type="text" class="form-control" name="secondChildName" placeholder="Second Child Name">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('secondChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('SecondChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('thirdChildName') ? ' has-error' : '' }}">
            {{-- <label for="thirdChildName" class="col-md-4 control-label">Third Child Name</label> --}}

            <div class="input-group col-md-8">
                <input id="thirdChildName" type="text" class="form-control" name="thirdChildName" placeholder="Third Child Name">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('thirdChildName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('thirdChildName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
</div>

        <div class="form-group{{ $errors->has('membershipType') ? ' has-error' : '' }}">
            {{-- <label for="membershipType" class="col-md-4 control-label">membership Type</label> --}}

            <div class="input-group col-md-8">
                <select name="membershipType" id="membershipType" class="selectpicker form-control" required="">
                    <option value="">Membership Type</option> 
                    <option value="annual">Annual Membership</option>
                    <option value="lifetime">Lifetime Membership</option>
                </select>
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('membershipType'))
                    <span class="help-block">
                        <strong>{{ $errors->first('membershipType') }}</strong>
                    </span>
                @endif
            </div>
        </div>

    </div>
                    


    <div class="col-md-6">
        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
            {{-- <label for="lastName" class="col-md-4 control-label">Last Name</label> --}}

            <div class="input-group col-md-8">
                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('lastName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('lastEmail') ? ' has-error' : '' }}">
            {{-- <label for="lastEmail" class="col-md-4 control-label">E-Mail Address</label> --}}

            <div class="input-group col-md-8">
                <input id="lastEmail" type="email" class="form-control" name="lastEmail" value="{{ old('lastEmail') }}" placeholder="Secondary Email">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>

                @if ($errors->has('lastEmail'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastEmail') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{-- <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label> --}}

            <div class="input-group col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Password" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            </div>
        </div>

        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
            {{-- <label for="dob" class="col-md-4 control-label">Date Of Birth</label> --}}

            <div class="input-group col-md-8">
                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" placeholder="Date Of Birth" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                @if ($errors->has('dob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dob') }}</strong>
                    </span>
                @endif
            </div>
        </div>

         <div class="form-group{{ $errors->has('phoneNo2') ? ' has-error' : '' }}">
            {{-- <label for="phoneNo2" class="col-md-4 control-label">Phone No2</label> --}}

            <div class="input-group col-md-8">
                <input id="phoneNo2" type="text" class="form-control" name="phoneNo2" placeholder="Phone No2">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>

                @if ($errors->has('phoneNo2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phoneNo2') }}</strong>
                    </span>
                @endif
            </div>
        </div>

         <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
            {{-- <label for="phoneNo1" class="col-md-4 control-label">Address2</label> --}}

            <div class="input-group col-md-8">
                <input id="address2" type="text" class="form-control" name="address2" placeholder="Address 2">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>

                @if ($errors->has('address2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address2') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
            {{-- <label for="phoneNo1" class="col-md-4 control-label">state</label> --}}

            <div class="input-group col-md-8">
                <input id="state" type="text" class="form-control" name="state" placeholder="state" required>
                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>

                @if ($errors->has('state'))
                    <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('maritalStaus') ? ' has-error' : '' }}">
            {{-- <label for="maritalStaus" class="col-md-4 control-label">Marital Status</label> --}}

            <div class="input-group col-md-8">
                <select name="maritalStatus" id="maritalStatus" class="selectpicker form-control" required="">
                    <option value="">Marital Status</option> 
                    <option value="married">Married</option>
                    <option value="single">Single</option>
                </select>
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                @if ($errors->has('maritalStaus'))
                    <span class="help-block">
                        <strong>{{ $errors->first('maritalStaus') }}</strong>
                    </span>
                @endif
            </div>
        </div>

<div class="family" style="display: none">
        <div class="form-group{{ $errors->has('spouseDob') ? ' has-error' : '' }}">
            {{-- <label for="spouseDob" class="col-md-4 control-label">Spouse DOB</label> --}}

            <div class="input-group col-md-8">
                <input id="spouseDob" type="date" class="form-control" name="spouseDob" placeholder="Spouse DOB">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                @if ($errors->has('spouseDob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('spouseDob') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('firstChildDob') ? ' has-error' : '' }}">
            {{-- <label for="firstChildDob" class="col-md-4 control-label">First Child DOB</label> --}}

            <div class="input-group col-md-8">
                <input id="firstChildDob" type="date" class="form-control" name="firstChildDob" placeholder="First Child DOB">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                @if ($errors->has('firstChildDob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstChildDob') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('secondChildDob') ? ' has-error' : '' }}">
            {{-- <label for="secondChildDob" class="col-md-4 control-label">Second Child DOB</label> --}}

            <div class="input-group col-md-8">
                <input id="secondChildDob" type="date" class="form-control" name="secondChildDob" placeholder="Second Child DOB">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                @if ($errors->has('secondChildDob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('secondChildDob') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('thirdChildDob') ? ' has-error' : '' }}">
            {{-- <label for="thirdChildDob" class="col-md-4 control-label">Third Child DOB</label> --}}

            <div class="input-group col-md-8">
                <input id="thirdChildDob" type="date" class="form-control" name="thirdChildDob" placeholder="Third Child DOB">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>

                @if ($errors->has('thirdChildDob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('thirdChildDob') }}</strong>
                    </span>
                @endif
            </div>
        </div>
</div>

    </div>

    <div class="form-group" style="margin-left: ">
        <div class="col-md-6 col-md-offset-4" >
            <button type="submit" class="btn btn-primary">
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
@endsection




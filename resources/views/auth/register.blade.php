@section('title', 'Register')
@include('register')
<nav class="navbar navbar-expand-md fixed-top" style="background-color: white;box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
">
<a class="navbar-brand" href="#"><img src="../../assets/img/thulir-logo-1.png"></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">


          <li class="nav-item ">
            <a href="{{route('login')}}" class="nav-link"><span class="glyphicon glyphicon-log-in"></span>SignIn</a>
        </li>
        <li class="nav-item active">
            <a href="{{route('register')}}" class="nav-link"><span class="glyphicon glyphicon-user"></span>SignUp</a>
        </li>

    </li>
</ul>

</div>
</nav><br>
<div class="row">
  <div class="col-xl-3 col-md-3">
  </div>
  <div class="col-xl-6 col-md-6">
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h4 class="text-uppercase">
                <strong><center>Registration</center></strong>
            </h4>
            <br/>
            <form  method="POST" action="{{ url('member_register') }}">
                @csrf
                <div class="col-md-12">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>First Name&nbsp;<span style="color:red">*</span><br></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="First Name" required autofocus>
                    </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Last Name&nbsp;<span style="color:red">*</span><br></label>
                    <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
                </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Email Id&nbsp;<span style="color:red">*</span><br></label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
            </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label>Password&nbsp;<span style="color:red">*</span><br></label>
            <input id="password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" name="password" placeholder="Enter Password" required>
        </div>
    </div>
     <div class="col-md-12">
          <div class="form-group">
            <label>Confirm Password&nbsp;<span style="color:red">*</span><br></label>
            <input id="confirm_password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" name="password_confirmation" placeholder="Re-type Password" required>
        </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label>Mobile No&nbsp;<span style="color:red">*</span><br></label>
        <input id="phoneNo1" type="text" class="form-control" name="phoneNo1" value="{{ old('phoneNo1') }}" placeholder="Mobile No" required>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="form-group" >
            <button type="submit" class="btn btn-primary submit">
                Register
            </button>
        </div>
    </div>
</div>
</form>
</div>
</div>
</div>
<div class="col-xl-3 col-md-3">
</div>
</div>




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





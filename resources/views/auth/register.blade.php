
@section('title', 'Login')
@include('main')
<!-- Main Content -->
<section class="wrapper">
      <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12">
           <div class="col-lg-2">
           </div>
          <div class="col-lg-8">
            <div class="blog classic-view">
              <article class="post">
                <div class="card">
                     <div class="card-header">
                        Member Login
                     </div>
                <div class="card-body">
                   @if(count($errors)>0)
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach 
                </ul>
              </div>
            @endif 
             @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
@if (Session::has('message'))

                         <div class="alert alert-success" role="alert">

                            {{ Session::get('message') }}

                        </div>

                    @endif
            <form  method="POST" action="{{ url('member_register') }}">
                @csrf
                <div class="col-md-12">
                    <div class="col-md-12 pb-4">
                      <div class="form-group">
                        <label>First Name&nbsp;<span style="color:red">*</span><br></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="First Name" required autofocus>
                    </div>
                </div>
                <div class="col-md-12 pb-4">
                  <div class="form-group">
                    <label>Last Name&nbsp;<span style="color:red">*</span><br></label>
                    <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
                </div>
            </div>
            <div class="col-md-12 pb-4">
              <div class="form-group">
                <label>Email Id&nbsp;<span style="color:red">*</span><br></label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
            </div>
        </div>


        <div class="col-md-12 pb-4">
          <div class="form-group">
            <label>Password&nbsp;<span style="color:red">*</span><br></label>
            <input id="password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" name="password" placeholder="Enter Password" required>
        </div>
    </div>
     <div class="col-md-12 pb-4">
          <div class="form-group">
            <label>Confirm Password&nbsp;<span style="color:red">*</span><br></label>
            <input id="confirm_password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" name="password_confirmation" placeholder="Re-type Password" required>
        </div>
    </div>
    <div class="col-md-12 pb-4">
      <div class="form-group">
        <label>Mobile No&nbsp;<span style="color:red">*</span><br></label>
        <input id="mobile_no" type="text" class="form-control" name="phoneNo1" value="{{ old('phoneNo1') }}" maxlength="10" placeholder="Mobile No" required>
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
</article>
</div>
</div>
</div>
</div>
</section>



<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {

      $("#mobile_no").keypress(function (e) {
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





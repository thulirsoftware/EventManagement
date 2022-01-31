@extends('layouts.user')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">   
         <div class="col-12">

          <div class="row mb-2">
            <div class="col-sm-2">
              <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-3">
          </div>


      </div>
  </div>
  <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
       @if(Session::has('success'))
       <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get('success')}}
    </div>
    @endif
    @if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get('warning')}}
    </div>
    @endif
       @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    <div class="card panel-default">
      <div class="card-header"><center><h4>Change Password</h4></center></div>

      <div class="card-body">
          <form class="form-horizontal" action="{{ url('/UpdatePassword') }}" method="POST">
              {{ csrf_field() }}

              <div class="row">
               <div class="col-md-12 form-group">
                <label class="control-label" for="youth_volunteer">Old Password :&nbsp;<span style="color:red">*</span></label>
                <div class="input-group input-group-md">
                    <input type="password" class="form-control"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" name="old_password" id="old_password" required="">
                    <span class="input-group-addon">
                      <button type="button" id="old_password" class="btn btn-default" onclick="viewPassword(this.id)">
                        <i class="fa fa-eye-slash" id="togglePassword_old" ></i></button>
                    </span>
                </div>

            </div>
            <div class="col-md-12 form-group">
                <label class="control-label" for="youth_volunteer">New Password :&nbsp;<span style="color:red">*</span></label>
               <div class="input-group input-group-md">
                    <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" name="password" id="new_password" required>
                    <span class="input-group-addon">
                      <button type="button" id="new_password" onclick="viewPassword(this.id)" class="btn btn-default">
                        <i class="fa fa-eye-slash" id="togglePassword_new" ></i></button>
                    </span>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <label class="control-label" for="youth_volunteer">Confirm Password :&nbsp;<span style="color:red">*</span></label>
                <div class="input-group input-group-md">
                    <input type="password" class="form-control"  name="password_confirmation" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" id="confirm_password" required>
                    <span class="input-group-addon">
                      <button type="button" id="confirm_password" onclick="viewPassword(this.id)" class="btn btn-default">
                        <i class="fa fa-eye-slash" id="togglePassword_confirm" ></i></button>
                    </span>
                </div>
                <span id='message'></span>
            </div>

        </div> 

        <div class="row">
                     <div class="col-md-4 form-group">
                     </div>
                     <div class="col-md-8 form-group">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
            <a href="/familyMembers" class="btn btn-warning">Cancel</a>
</div>
        </div><br>

    </form>

</div>










</div>
</div>
</div>
</div>
</section>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>
    function viewPassword(id)
    {
        if(id=="old_password")
        {
            if ( $('#togglePassword_old').hasClass('fa fa-eye-slash'))
            {
                $("#togglePassword_old").removeClass("fa fa-eye-slash");
                 $('#togglePassword_old').addClass('fa fa-eye');
                document.getElementById("old_password").type="text"; 
            }
            else
            {
                 $("#togglePassword_old").removeClass("fa fa-eye");
                 $('#togglePassword_old').addClass('fa fa-eye-slash');
                document.getElementById("old_password").type="password"; 
            }
        }
        else if(id=="new_password")
        {
            if ( $('#togglePassword_new').hasClass('fa fa-eye-slash'))
            {
                $("#togglePassword_new").removeClass("fa fa-eye-slash");
                 $('#togglePassword_new').addClass('fa fa-eye');
                document.getElementById("new_password").type="text"; 
            }
            else
            {
                 $("#togglePassword_new").removeClass("fa fa-eye");
                 $('#togglePassword_new').addClass('fa fa-eye-slash');
                document.getElementById("new_password").type="password"; 
            }
        }
        else
        {
            if ( $('#togglePassword_confirm').hasClass('fa fa-eye-slash'))
            {
                $("#togglePassword_confirm").removeClass("fa fa-eye-slash");
                 $('#togglePassword_confirm').addClass('fa fa-eye');
                document.getElementById("confirm_password").type="text"; 
            }
            else
            {
                 $("#togglePassword_confirm").removeClass("fa fa-eye");
                 $('#togglePassword_confirm').addClass('fa fa-eye-slash');
                document.getElementById("confirm_password").type="password"; 
            }
        }
    }
</script>

@endsection

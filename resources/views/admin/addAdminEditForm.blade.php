@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/admin/manageAdmin" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        
      </div>
    </div>
      <div class="row">
        <div class="col-md-2">
      </div>
       <div class="col-md-7">
            <div class="card">
              <div class="card-header"><center><strong>Edit Admin</strong></center></div>
              <div class="card-body">
                  <form class="form-horizontal" action="{{ url('admin/adminUpdate') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $admin['id']}}">
                <div class="row">                        
                  <div class="col-md-6 form-group">
                    <label for="name">First Name:&nbsp;<span style="color:red">*</span></label>
                      <input type="text" class="form-control" id="name" placeholder="Enter First Name" name="firstname" value="{{ $admin['name']}}" required>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="job_title">Role:&nbsp;<span style="color:red">*</span></label>
                      <select name="role" class="form-control" required>
                        <option value="SAdmin" <?= $admin['job_title'] == "SAdmin"?'selected':'' ?> >Super Admin</option>
                        <option value="Admin" <?= $admin['job_title'] == "Admin"?'selected':'' ?> >Admin</option>
                      </select>
                  </div>
                 
                </div>
                <div class="row">

                  

                  <div class="col-md-6 form-group">
                    <label for="email">Email :&nbsp;<span style="color:red">*</span></label>
                      <input type="email" class="form-control" id="email" placeholder="User Name" name="userName" value="{{ $admin['email']}}" required>
                  </div>
                   
                </div>
               
                  <div class="col-md-6 form-group">        
                    <center>
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      <a class="btn  btn-warning" href="{{ url('admin/manageAdmin') }}">Cancel</a>
                    </center>
                  </div>

                    </form>
                </div>
            </div>
          </div>
          <div class="col-md-2">
      </div>
        </div>
    </div>
</div>
</section>
</div>
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
@endsection

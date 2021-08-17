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
              <div class="card-header"><center><strong>Add Admin</strong></center></div>
              <div class="card-body">
                  <form class="form-horizontal" action="{{ url('admin/addAdmin') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" class="form-control" id="" placeholder="Role" name="is_active" value="yes">
                  <div class="row">                        
                  <div class="col-md-6 form-group">
                    <label for="name">Name:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-control" name="firstname" id="firstname"   required>
                <option value=""> Choose Name</option>
                @foreach($membername as $membername) 
                <option value="{{$membername->firstName}}">{{ $membername->firstName}}</option>
                @endforeach
            </select>
                  </div>
                   <div class="col-md-6 form-group">
                    <label for="email">Email:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-control" name="userName" id="userName"   required>
                <option value=""> Choose Email</option>
                @foreach($memberemail as $memberemail) 
                <option value="{{$memberemail->Email_Id}}">{{ $memberemail->Email_Id}}</option>
                @endforeach
            </select>
                  </div>
               
                </div>
                <div class="row"> 
                  <div class="col-md-6 form-group">
                    <label for="password">Password:&nbsp;<span style="color:red">*</span></label>
                      <input type="password" class="form-control" id="password-field" placeholder="Password" name="password">
                       <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  </div>


                  <div class="col-md-6 form-group">
                    <label for="job_title">Role:&nbsp;<span style="color:red">*</span></label>
                      <select name="role" class="form-control" required>
                      <option value="SAdmin">Super Admin</option>
                      <option value="Admin">Admin</option>
                      </select>
                  </div>
                </div>
                 

                  <div class="form-group">        
                    <center>
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      <a class="btn btn-warning" href="{{ url('admin/manageAdmin') }}">Cancel</a>
                    </center>

                  </div>

                    </form>
                </div>
                @if(Auth::user()->job_title!='Admin')
                <div class="card-footer">
                 Admin will not have the following privileges  :
<br><br>
<ul>
  <li>
    admin who can make all in the admin app expect enabling the members</li><br>
<li>

    Super admin who can make all changes in the admin including enabling members who paid in cash or cheque.
                </li>
                </ul>   <br>
                 
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-2">
      </div>
    </div>
</div>
</section>
</div>

@endsection

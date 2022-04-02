@extends('layouts.admin')
@section('content')
<style>
    .select2-selection__rendered {
    line-height: 31px !important;
    
}
.select2-container .select2-selection--single {
    height: 50px !important;
         border: 1px solid rgba(63, 120, 224, 0.7);
border-radius: 0.4rem;
color: #959ca9;
}
.select2-selection__arrow {
    height: 50px !important;
    color: #959ca9;

}
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
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
                 
                   <div class="col-md-12 form-group">
                    <label for="email">Email:&nbsp;<span style="color:red">*</span></label>
                       <select  class="form-select" name="email" id="addAdmin_email"   required>
                <option value=""> Choose Email</option>
                @foreach($memberemail as $memberemail) 
                <option value="{{$memberemail->email}}">{{ $memberemail->email}}</option>
                @endforeach
            </select>
                  </div>
               
                </div>
                <div class="row"> 
             
                  <div class="col-md-12 form-group">
                    <label for="job_title">Role:&nbsp;<span style="color:red">*</span></label>
                      <select name="role"  class="form-select" required>
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

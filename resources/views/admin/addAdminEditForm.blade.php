@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading" style="background-color:brown;color:white;font-size:18px;font-weight:bold">Add Member</div>

               <div class="panel-body" style="background-color:#f3f4c6">
                  <form class="form-horizontal" action="{{ url('admin/adminUpdate') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $admin['id']}}">
                                          
                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="name">Name:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $admin['name']}}" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="job_title">Role:</label>
                    <div class="col-sm-5">          
                      <input type="text" class="form-control" id="job_title" placeholder="Role" name="role" value="{{ $admin['job_title']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="email">Email :</label>
                    <div class="col-sm-5">          
                      <input type="email" class="form-control" id="email" placeholder="User Name" name="userName" value="{{ $admin['email']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="active">Active:</label>
                    <div class="col-sm-5">          
                      <input type="text" class="form-control" id="active" placeholder="" name="isActive" value="{{ $admin['is_active']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="password">Password:</label>
                    <div class="col-sm-5">          
                      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                    </div>
                  </div>

                  <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-4 col-md-offset-5">
                      <button type="submit" class="btn btn-default btn-lg btn-primary" name="submit">Submit</button>
                    </div>
                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

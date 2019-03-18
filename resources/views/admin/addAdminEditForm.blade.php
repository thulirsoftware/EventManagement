@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Add Member</div>

               <div class="panel-body">
                  <form class="form-horizontal" action="{{ url('admin/adminUpdate') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $admin['id']}}">
                                          
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="name">Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $admin['name']}}" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="job_title">Role:</label>
                    <div class="col-sm-4">          
                      <input type="text" class="form-control" id="job_title" placeholder="Role" name="role" value="{{ $admin['job_title']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="email">User Name:</label>
                    <div class="col-sm-4">          
                      <input type="text" class="form-control" id="email" placeholder="User Name" name="userName" value="{{ $admin['email']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="active">Active:</label>
                    <div class="col-sm-4">          
                      <input type="text" class="form-control" id="active" placeholder="" name="isActive" value="{{ $admin['is_active']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="password">Password:</label>
                    <div class="col-sm-4">          
                      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                    </div>
                  </div>

                  <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-4">
                      <button type="submit" class="btn btn-default" name="submit">Submit</button>
                    </div>
                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

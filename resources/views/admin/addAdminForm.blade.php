@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="panel" style="padding-top:15px">
                <div class="panel-heading"  style="background-color:brown;color:white">Add Member</div>

               <div class="panel-body"  style="background-color:#f9f3c7;">
                  <form class="form-horizontal" action="{{ url('admin/addAdmin') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" class="form-control" id="" placeholder="Role" name="is_active" value="yes">
                                          
                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="name">Name:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="email">Email:</label>
                    <div class="col-sm-6">          
                      <input type="email" class="form-control" id="email" placeholder="Email" name="userName">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="job_title">Role:</label>
                    <div class="col-sm-6">          
                     {{--  <input type="text" class="form-control" id="job_title" placeholder="Role" name="role"> --}}
                      <select name="role">
                      <option value="SAdmin">Super Admin</option>
                      <option value="Admin">Admin</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="password">Password:</label>
                    <div class="col-sm-6">          
                      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                    </div>
                  </div>

                  <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-4 col-md-offset-5">
                      <button type="submit" class="btn btn-default btn-lg btn-primary" name="submit">Submit</button>
                      <a class="btn btn-default btn-close btn-lg btn-primary" href="{{ url('admin/manageAdmin') }}">Cancel</a>
                    </div>

                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

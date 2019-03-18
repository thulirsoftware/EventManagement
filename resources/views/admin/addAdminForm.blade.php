@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Add Member</div>

               <div class="panel-body">
                  <form class="form-horizontal" action="{{ url('admin/addAdmin') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" class="form-control" id="" placeholder="Role" name="is_active" value="yes">
                                          
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="name">Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="email">User Name:</label>
                    <div class="col-sm-4">          
                      <input type="text" class="form-control" id="email" placeholder="User Name" name="userName">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="job_title">Role:</label>
                    <div class="col-sm-4">          
                      <input type="text" class="form-control" id="job_title" placeholder="Role" name="role">
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
                      <a class="btn btn-default btn-close" href="{{ url('admin/manageAdmin') }}">Cancel</a>
                    </div>

                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

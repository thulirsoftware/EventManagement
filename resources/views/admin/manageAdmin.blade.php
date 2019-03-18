@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Add Member<span style="float: right"><a href="{{ url('admin/addAdmin') }}">Add Admin</a></span></div>

              <div class="panel-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>User Name</th>
                      <th>Role</th>
                      <th>Active</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($admins as $admin)
                        <tr>
                         
                          <td>{{ $admin['name'] }}</td>
                          <td>{{ $admin['email'] }}</td>
                          <td>{{ $admin['job_title'] }}</td>
                          <td>{{ $admin['is_active'] }}</td>
                          <td><a href="/admin/adminEdit/{{ $admin['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/admin/adminDelete/{{ $admin['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

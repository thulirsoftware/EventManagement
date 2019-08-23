@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-2">
           
                <a style="background-color:brown;color:white;border-radius:5px;font-size:18px;padding:15px;margin-top:15px" href="{{ url('admin/addAdmin') }}">Add Admin</a>
              
                <table class="table" style="margin-top:25px">
                  <thead style="background-color:brown">
                    <tr>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Name</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Email Id</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Role</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Active</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Edit</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($admins as $admin)
                        <tr style="background-color:#f3f4c6">
                         
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $admin['fname'] }} {{ $admin['lname'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $admin['email'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $admin['job_title'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $admin['is_active'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;"><a href="/admin/adminEdit/{{ $admin['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;"><a href="/admin/adminDelete/{{ $admin['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
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

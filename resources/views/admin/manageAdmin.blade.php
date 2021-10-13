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
    <div class="row">
        <div class="col-md-11 col-md-offset-2">
            
              
              
                <div class="add-button" >
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/addAdmin') }}">Add Admin</a> 
          </div><br><br>
          <div class="card">
            @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
<div class="card-body">
                <table  class="table table-bordered table-striped" id="manageadmin_list">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Id</th>
                      <th>Role</th>
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
                        @if($admin['job_title']!='SAdmin')
                          <td><a href="/admin/adminEdit/{{ $admin['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:center;"></i></a></td>
                          
                          <td><a  onclick="myFunction({{$admin['id']}})"><i class="fa fa-trash fa-lg" style="text-align:center;color: #0069d9;cursor:pointer"></i></a></td>
                          @else
                          <td></td>
                          <td></td>
                        @endif
                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
      </div>
      </div>
    </div>
  </section>
</div>

<script>
function myFunction(id) {
   if (confirm("Are you Sure you want to delete the user?")) {
        $.ajax({
            type : 'get',
            url : '{{URL::to('admin/adminDelete')}}',
            data : {'id':id},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>
@endsection

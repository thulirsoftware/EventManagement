@extends('layouts.admin')
@section('content')
<div class="container" style="padding-top:15px">
    <div class="row">
        <div class="col-md-11 col-md-offset-2">
            <div class="card">
              
              <div class="card-body">
                <div class="add-button" >
            <a class="btn btn-primary btn-md" style="float:right;color:white" href="{{ url('admin/addSchool') }}">Add School</a> 
          </div><br><br>
                <table class="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>School Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>  
                      @foreach($schools as $school)
                        <tr>

                          <td>{{ $i++ }}</td>
                          <td>{{ $school['name'] }}</td>
                          <td><a href="/admin/schoolEdit/{{ $school['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/admin/schoolDelete/{{ $school['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
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

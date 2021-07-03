@extends('layouts.admin')
@section('content')
<div class="container" style="padding-top:15px">
    <div class="row">
        <div class="col-md-11 col-md-offset-2">
            <div class="card">
              <div class="card-header"><center><strong>Add School</strong></center></div>
              <div class="card-body">
                  <form class="form-horizontal" action="{{ url('admin/addSchoolPost') }}" method="POST">
                      {{ csrf_field() }}
                                          
                  <div class="form-group">
                    <label for="schoolName">School Name:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="schoolName" placeholder="Enter School Name" name="schoolName" required>
                    </div>
                  </div>

                  <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-4 col-md-offset-5">
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-primary" href="{{ url('admin/manageSchool') }}">Cancel</a>
                    </div>

                  </div>

                    </form>
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

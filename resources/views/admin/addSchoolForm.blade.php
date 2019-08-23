@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="panel" style="padding-top:15px">
                <div class="panel-heading"  style="background-color:brown;color:white">Add Member</div>

               <div class="panel-body"  style="background-color:#f9f3c7;">
                  <form class="form-horizontal" action="{{ url('admin/addSchoolPost') }}" method="POST">
                      {{ csrf_field() }}
                                          
                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="schoolName">School Name:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="schoolName" placeholder="Enter School Name" name="schoolName" required>
                    </div>
                  </div>

                  <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-4 col-md-offset-5">
                      <button type="submit" class="btn btn-default btn-lg btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-default btn-close btn-lg btn-primary" href="{{ url('admin/manageSchool') }}">Cancel</a>
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

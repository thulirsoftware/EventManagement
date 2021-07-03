@extends('layouts.admin')

@section('content')
<div class="container" style="padding-top:15px">
    <div class="row">
        <div class="col-md-11 col-md-offset-2">
            <div class="card">
              <div class="card-header"><center><strong>Edit School</strong></center></div>
              <div class="card-body">
  <form method="post" action="{{ url('admin/schoolUpdate') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

  <input type="hidden" name="schoolId" value="{{ $school['id'] }}">

    <div class="col-md-10">    	  
      	<div class="form-group col-md-offset-2 col-md-12">
      		<label>School Name</label>
            <input type="text" class="col-md-8 form-control" name="schoolName" id="schoolName" value="{{ $school['name'] }}" required="">
      	</div>

      <div class="col-md-offset-2 col-md-12 bottom" >
          <center>
            <input class="btn btn-info" type="submit" name="submit" value="submit">
            <a class="btn btn-info" href="{{ url('admin/manageSchool') }}">Cancel</a>
        </center>
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
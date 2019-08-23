@extends('layouts.user')

@section('content')
<style>
.col-md-6{
	margin-top:20px;
}
.bottom
{
	margin-top:20px;
}
p{
	font-size: 25px;
	color:brown;
}
</style>

<div class="col-md-offset-1 col-md-12">
<center><p>Edit Family Members</p></center>
  <form method="post" action="">
    <div class="col-md-6">
      <div class="input-group col-md-offset-6 col-md-6">
          First Name:<input id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	Last Name:
          <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Last Name">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	Gender:
          <input id="gender" type="text" class="form-control" name="gender" placeholder="Gender">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	Age:
          <input id="age" type="text" class="form-control" name="age" placeholder="Age">
      </div>
      <div class="input-group col-md-offset-6 col-md-6">
      	Relationship:
          <input id="relationship" type="text" class="form-control" name="relationship" placeholder="Relationship">
      </div>
    </div>

    <div class="col-md-12 bottom">
        <center>
        	<input type="submit" name="submit" value="Update" style="background-color: brown;color:yellow;padding:8px">
        	<a href="{{ URL::previous() }}" class="btn btn-info" style="margin-left: 50px;background-color: brown;color:yellow">Cancel</a>	
        </center>
    </div>
  </form>

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
@extends('layouts.admin')

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

<div class="col-md-offset-3 col-md-8" style="background-color:#f3f4c6">
<center><p style="padding-top:25px">Edit Member Profile</p></center>
 

  <form method="post" action="{{ url('/admin/editMemberUpdate') }}">
    {{ csrf_field() }}

    <input type="hidden" name="memberId" value="{{ $member['id'] }}">
    <input type="hidden" name="userId" value="{{ $user['id'] }}">

    <div class="col-md-10">
   
      <div class="input-group col-md-offset-3 col-md-6">
        <label>Email :</label>
          <input style="border-radius: 4px" type="text" class="form-control" name="email" value="{{ $member['primaryEmail'] }}">
      </div>

      <div class="input-group col-md-offset-3 col-md-6">
        <label>First Name :</label>
          <input  style="border-radius: 4px" type="text" class="form-control" name="firstName" value="{{ $member['firstName'] }}">
      </div>

      <div class="input-group col-md-offset-3 col-md-6">
        <label>Last Name :</label>
          <input style="border-radius: 4px" type="text" class="form-control" name="lastName" value="{{ $member['lastName'] }}">
      </div>

    </div>

    <div class="col-md-12 bottom" style="padding-bottom:25px">
        <center>
        	<input type="submit" class="btn btn-default btn-close btn-lg btn-primary" name="submit" value="Update" style="background-color: brown;color:yellow;padding:8px">
          <a class="btn btn-default btn-close btn-lg btn-primary" href="{{ url('admin/memberDetails') }}" style="background-color: brown;color:yellow;padding:8px">Cancel</a>
        </center>
    </div>
  </form>

</div>



@endsection
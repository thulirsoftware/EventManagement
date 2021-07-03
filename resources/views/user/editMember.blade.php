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
     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-md-3">
        </div>
         <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        
        
      </div>
    </div>
     <div class="row">
      <div class="col-md-2">
      </div>
        <div class="col-md-7">
            <div class="card">
              <div class="card-header"><center><strong>Edit Member</strong></center></div>
              <div class="card-body">
 

  <form method="post" action="{{ url('/admin/editMemberUpdate') }}">
    {{ csrf_field() }}

    <input type="hidden" name="memberId" value="{{ $member['id'] }}">
    <input type="hidden" name="userId" value="{{ $user['id'] }}">

    <div class="col-md-10">
   
      <div class="form-group col-md-offset-3 col-md-6">
        <label>Email :</label>
          <input style="border-radius: 4px" type="text" class="form-control" name="email" value="{{ $member['primaryEmail'] }}">
      </div>

      <div class="form-group col-md-offset-3 col-md-6">
        <label>First Name :</label>
          <input  style="border-radius: 4px" type="text" class="form-control" name="firstName" value="{{ $member['firstName'] }}">
      </div>

      <div class="form-group col-md-offset-3 col-md-6">
        <label>Last Name :</label>
          <input style="border-radius: 4px" type="text" class="form-control" name="lastName" value="{{ $member['lastName'] }}">
      </div>

    </div>

    <div class="col-md-12 bottom" style="padding-bottom:25px">
        <center>
        	<input type="submit" class="btn btn-primary" name="submit" value="Update">
          <a class="btn btn-warning" href="javascript:history.back()">Cancel</a>
        </center>
    </div>
  </form>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>


@endsection
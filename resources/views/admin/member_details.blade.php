@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">    <div class="row">
        <div class="col-md-11 col-md-offset-2">
            <div class="card">
              
              <div class="card-body">
                  
                <div class="row">
                  <div class="col-md-5 form-group">
                     <select class="form-control select2" name="membersearch" style="width: 100%;height:50px;" id="mobile_number">
                    <option selected="selected" value="">Mobile Number</option>
                     @foreach ($members as $member)
                          <option value="{{ $member->phoneNo1 }}">{{ $member->phoneNo1 }}</option>
                          @endforeach 
                  </select>
                    
                  </div>

                  <div class="col-md-5 form-group">
                      <select class="form-control Member_Id" name="membersearch" style="width: 100%;height:50px;">
                    <option  value="">TagDv Id</option>
                     @foreach ($members as $member)
                          <option value="{{ $member->Member_Id }}">{{ $member->Member_Id }}</option>
                          @endforeach 
                  </select>
                      
                  </div>
                </div>
                
                
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Mobile Number</th>
                      <th>Email</th>
                      <th>State</th>
                      <th>Membership Type</th>
                      <th>Expiry Date</th>
                    </tr>
                  </thead>
                  <tbody id="membersearch">  
                  
                  </tbody> 
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  
@endsection
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
          <a href="/admin/manageEvent" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        
      </div>
    </div>
      <div class="row">
       
        <div class="col-md-1">
      </div>
       <div class="col-md-10">
        <form method="post" action="{{ url('admin/Event/addEventFoodTicketPost') }}" enctype="multipart/form-data" id="regForm">

    {{ csrf_field() }}
            <div class="card">
               @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
  <div class="card-header"><center><strong>Add Event Food Ticket</strong></center></div>
              <br>
            <input type="hidden" name="eventId" value="{{$id}}">
<div class="card-body">
         <div class="col-md-12">
          <div class="row">
    
        <div class="col-md-6 form-group ">
          <label class="names">Age Group:&nbsp;<span style="color: red">*</span></label>
          <select class="form-control" name="FoodageGroup" id="sel1" required> 
            <option value="">Select</option>
            <option value="Adult">Adult</option>
             <option value="kids">Kids</option>
          </select>
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Member:&nbsp;<span style="color: red">*</span></label>
          <select class="form-control" name="FoodmemberType" id="sel1" required>
            <option value="">Select</option>
            <option value="Member">Member</option>
             <option value="NonMember">NonMember</option>
          </select>
        </div>
        <div class="col-md-6 form-group ">
          <label class="names">Food:&nbsp;<span style="color: red">*</span></label>
          <select class="form-control" name="foodType" id="sel1" required>
            <option value="">Select</option>
            <option value="veg">Veg</option>
            <option value="nveg">Non-VEg</option>
            <option value="no-food">No Food</option>
          </select>
        </div>
       
         <div class="col-md-6 form-group ">
          <label class="names">Price ($):&nbsp;<span style="color: red">*</span></label>
          <input class="form-control" type="text" name="FoodticketPrice" id="price" required>
        </div>
      </div>
        
        
        
    </div>
    <div style="overflow:auto;">
    <center>
      <button type="submit" class="button nextBtn" id="nextBtn" >Submit</button>
    </center>
  </div>
</div>

</div>
</form>
</div>
</div>
</div>
</div>




<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


@endsection
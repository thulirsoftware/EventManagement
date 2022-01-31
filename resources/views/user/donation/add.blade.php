@extends('layouts.user')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">   
  
     <div class="row">
      <div class="col-md-2">
      </div>
        <div class="col-md-8">
            <div class="card panel-default">
                 @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{Session::get('success')}}
                    </div>
                @endif
              <div class="card-header"><center><h4>Donation</h4></center></div>

                <div class="card-body">
                  <form class="form-horizontal" action="{{ url('/donation/add') }}" method="POST">
                      {{ csrf_field() }}

                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">Name:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                    </div>
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">Email:&nbsp;<span style="color:red">*</span></label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    
                    
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="phoneNo">Phone No:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="phoneNo" maxlength="10" placeholder="Phone No" name="phone" maxlength="10" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="phoneNo">Amount:&nbsp;<span style="color:red">*</span></label>
                        <input type="number" class="form-control" id="amount"  placeholder="Amount" name="amount" min="2">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">Address:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="address" placeholder="address" name="address" required="">
                    </div>
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">City:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="city" placeholder="City" name="city" required="" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">Zip Code:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="pincode" placeholder="Pincode" name="pincode" required=""  maxlength="7" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">Comments</label>
                        <textarea class="form-control" name="comments"></textarea>
                    </div>
                   
                   
                   
                   
                </div> 
                <div class="row">
                     <div class="col-md-4 form-group">
                     </div>
                     <div class="col-md-8 form-group">
                          <button type="submit" class="btn btn-primary">Donate</button>
                                                <a href="/familyMembers" class="btn btn-warning">Cancel</a>
                     </div>
                </div>
             <br>

                    </form>

                  </div>




                 

                  

                 
                    
               </div>
             </div>
           </div>
         </div>
</section>
</div>

<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>


<script type="text/javascript">
  $(document).ready(function () {

    $("#phoneNo").keypress(function (e) {
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $("#errmsgDate").html("Digits Only").show().fadeOut("slow");
          return false;
      }
  });

    $("#pincode").keypress(function (e) {
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $("#errmsgMonth").html("Digits Only").show().fadeOut("slow");
          return false;
      }
    });
 });
</script>

@endsection

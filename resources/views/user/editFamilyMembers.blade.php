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
        <div class="col-md-8">
            <div class="card panel-default">
              <div class="card-header"><center><h4>Edit Family Member</h4></center></div>

                <div class="card-body">
                  <form class="form-horizontal" action="{{ url('/familyUpdate') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $family['id']}}">
                  <input type="hidden" name="tagDvId" value="{{ $family['tagDvId']}}">
                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">First Name:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" name="firstName" value="{{ $family['firstName']}}" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required="">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="lastName">Last Name:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="lastName" value="{{ $family['lastName']}}">
                    </div>
                    <?php
                    $date =  Carbon\Carbon::now();
                    $dates = $date->toDateString();
                    ?>
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="lastName">DOB:&nbsp;<span style="color:red">*</span></label>
                        <input type="date" class="form-control" id="dob" placeholder="DOB" name="dob"  max="{{$dates}}" value="{{ $family['dob']}}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="relationshipType">Relationship:&nbsp;<span style="color:red">*</span></label>
                        <select class="form-select" name="relationshipType" required="">
                            <option value="">Select Relationship</option>
                            @foreach($membership as $membership)
                             <option value="{{$membership->name}}" @if( $family['relationshipType']==$membership->name) selected @endif>{{$membership->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="phoneNo">Phone No:</label>
                        <input type="text" class="form-control" id="EditphoneNo" maxlength="10" placeholder="Enter Phone No" name="phoneNo" value="{{ $family['phoneNo']}}">
                    </div>
                    

                    
                </div> 
                  
                     <div class="row">
                     <div class="col-md-4 form-group">
                     </div>
                     <div class="col-md-8 form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="/familyMembers" class="btn btn-warning">Cancel</a>

                    </div></div><br>                 
                </form>

                  </div>




                 

                  

                 
                

                    
               </div>
             </div>
           </div>
         </div>
       </div>

</section>
</div>


<script type="text/javascript">
  $(document).ready(function () {

  $("#dobDate").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsgDate").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

  $("#dobMonth").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsgMonth").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

});
</script>
<script language="javascript">
$(document).ready(function(){
  $("#dobDate").focus(function(){
    $("#day").hide();
  });
});
</script>
<script language="javascript">
$(document).ready(function(){
  $("#dobMonth").focus(function(){
    $("#month").hide();
  });
});
</script>
@endsection

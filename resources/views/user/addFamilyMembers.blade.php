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
                 @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{Session::get('success')}}
                    </div>
                @endif
                 @if(Session::has('warning'))
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('warning')}}
                  </div>
              @endif
              <div class="card-header"><center><h4>Add Family Member</h4></center></div>

                <div class="card-body">
                  <form class="form-horizontal" action="{{ url('/addFamilyMembers') }}" method="POST" onsubmit="return validateForm()">
                      {{ csrf_field() }}
                                <input type="hidden" name="tagDvId" value="{{ $tagDvId }}">

                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="firstName">First Name:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required="">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="lastName">Last Name:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                    </div>
                    <?php
                    $date =  Carbon\Carbon::now();
                    $dates = $date->toDateString();
                    $member = \App\Member::where('user_id',\auth()->user()->id)->first();
                    ?>
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="lastName">DOB:&nbsp;<span style="color:red">*</span></label>
                        <input type="date" class="form-control" id="dob" placeholder="DOB" name="dob"  max="{{$dates}}" >
                    </div>
                    @if($member!=null)
                     <div class="col-md-6 form-group">
                        <label class="control-label" for="membershipType">Membership:&nbsp;<span style="color:red">*</span></label>
                         <input type="text" class="form-control" id="membershipType"  value="{{$member['membershipType']}}" disabled>

                    
                    </div>
                    <div class="col-md-6 form-group" id="relationshipTypeRow">
                        <label class="control-label" for="relationshipType">Relationship:&nbsp;<span style="color:red">*</span></label>
                        <select class="form-select" name="relationshipType" id="relationshipType">
                          
                        </select>
                    </div>
                    @else
                    <div class="col-md-6 form-group" id="relationshipTypeRow">
                        <label class="control-label" for="relationshipType">Relationship:&nbsp;<span style="color:red">*</span></label>
                        <select class="form-select" name="relationshipType" id="relationshipType">
                            <option value="">Select relationship type</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Daughter">Daughter</option>
                            <option value="Son">Son</option>
                            <option value="Mother">Mother</option>
                            <option value="Father">Father</option>
                            <option value="Mother In Law">Mother In Law</option>
                            <option value="Father In Law">Father In Law</option>
                        </select>
                    </div>
                    
                    @endif
                    <div class="col-md-6 form-group">
                        <label class="control-label" for="phoneNo">Phone No:</label>
                        <input type="text" class="form-control" id="phoneNo" maxlength="10" placeholder="Phone No" name="phoneNo" >
                    </div>
                   
                   
                   
                </div> 
                            
                 <div class="row">
                     <div class="col-md-4 form-group">
                     </div>
                     <div class="col-md-8 form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="/familyMembers" class="btn btn-warning">Cancel</a>
</div>
                    </div><br>

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
function selectMembership(type)
{
    if(type=='Single')
    {
         $('#relationshipTypeRow').hide();
         alert('you are choosing single membership you cannot add family members')
    }
    else
    {
        $('#relationshipTypeRow').show();
        var substateArray1 =  @json($membership);
        var filteredArray1 = substateArray1.filter(x => x.membership_code == type);
        console.log(filteredArray1[0]['membership_type']);

        var substateArray2 =  @json($membershipMandatory);
        var filteredArray2 = substateArray2.filter(x => x.membership_id == filteredArray1[0]['membership_type']);

        $('#relationshipType').empty();
        $('#relationshipType').append('<option value="">Select Relationship</option>');
        $.each(filteredArray2, function (index, value) {
        $('#relationshipType').append('<option value="' + value.name + '">' + value.name +' </option>');
         });
     }
}
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
function validateForm(){
    var birthday = document.getElementById('dob').value;
    var relationshipType = document.getElementById('relationshipType').value;
	var optimizedBirthday = birthday.replace(/-/g, "/");

	var myBirthday = new Date(optimizedBirthday);

	var currentDate = new Date().toJSON().slice(0,10)+' 01:00:00';
    if(relationshipType!="Son" && relationshipType!="Daughter")
    {
	var myAge = ~~((Date.now(currentDate) - myBirthday) / (31557600000));

	if(myAge < 18) {
	        alert('Age must be greater than 18')
     	    return false;
        }else{
	    return true;
	}
    }
    else
    {
        return true;
    }

}
</script>
<script language="javascript">
$(document).ready(function(){
    var type = document.getElementById('membershipType').value;
    selectMembership(type);
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
